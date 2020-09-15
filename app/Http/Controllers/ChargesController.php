<?php

namespace App\Http\Controllers;

use App\Fase;
use App\Conta;
use App\Produto;
use Carbon\Carbon;
use App\DocTransacao;
use App\Responsabilidade;
use App\Events\StoreCharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreChargeRequest;
use App\Http\Requests\UpdateChargeRequest;

class ChargesController extends Controller
{
    public function listProducts()
    {
        $products = null;
        $fasesPendentes = null;
        $fasesPagas = null;
        $fasesDivida = null;
        $numberProducts = null;

        if(Auth()->user()->tipo == 'admin'){
            $products = Produto::orderByRaw("FIELD(estado, \"Crédito\", \"Dívida\", \"Pendente\", \"Pago\")")->get();
        }elseif(Auth()->user()->tipo == 'agente' && Auth()->user()->agente->tipo == "Agente"){
            $products = Produto::where('idAgente', Auth()->user()->idAgente);
        }elseif(Auth()->user()->tipo == 'agente' && Auth()->user()->agente->tipo == "Subagente"){
            $products = Produto::where('idSubAgente', Auth()->user()->idAgente);
        }else{
            $products = Produto::where('idCliente', Auth()->user()->idCliente);
        }

        foreach($products as $product){
            $fases = $product->fase;

              foreach($fases as $fase){
                if($fase->estado == 'Pendente'){
                  $fasesPendentes[] = $fase;
                }
                if($fase->estado == 'Pago'){
                  $fasesPagas[] = $fase;
                }
                if($fase->estado == 'Dívida'){
                  $fasesDivida[] = $fase;
                }
              }

              if($product->valorTotal != 0){
                $numberProducts[] = $product;
              }
        }
        return view('charges.list-products', compact('products', 'numberProducts', 'fasesPendentes', 'fasesPagas', 'fasesDivida'));
    }

    public function listFases(Produto $product)
    {
        $docTransacao = DocTransacao::all();
        $fases = Fase::where('idProduto', $product->idProduto)
        ->orderByRaw("FIELD(estado, \"Pendente\", \"Pago\")")
        ->orderBy('dataVencimento', 'ASC')
        ->with(["produto", "docTransacao"])
        ->get();
        return view('charges.list-fases', compact('product', 'fases', 'docTransacao'));
    }

    public function show(Produto $product, Fase $fase, DocTransacao $docTransacao)
    {
        return view('charges.show', compact('product', 'fase', 'docTransacao'));
    }

    public function create(Produto $product, Fase $fase)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null){
            $contas = Conta::all();
            $docTransacao = new DocTransacao;
            return view('charges.add', compact('product', 'fase', 'docTransacao', 'contas'));
        }else{
            abort(403);
        }
    }

    public function store(Request $request, StoreChargeRequest $requestCharge, Produto $product, Fase $fase)
    {
      if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null){
        $docTransacao = new DocTransacao;
        $fields = $requestCharge->validated();
        $docTransacao->fill($fields);
        $docTransacao->valorRecebido = str_replace(',', '.', $docTransacao->valorRecebido);

        $idConta = $request->input('conta');
        $docTransacao->idConta = $idConta;

        $docTransacao->descricao = 'Cobrança da '.$fase->descricao;
        $docTransacao->idFase = $fase->idFase;

        $docTransacao->save();

        if ($requestCharge->hasFile('comprovativoPagamento')) {
            $file = $requestCharge->file('comprovativoPagamento');
            $filename= post_slug($docTransacao->descricao).'-comprovativo-'.$docTransacao->idDocTransacao.'.'.$file->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('comprovativos-pagamento/', $file, $filename);
            $docTransacao->comprovativoPagamento = $filename;
            $docTransacao->save();
        }

        switch ($docTransacao->valorRecebido) {
            case $docTransacao->valorRecebido == $fase->valorFase:
                Fase::where('idFase', $fase->idFase)
                ->update([
                    'verificacaoPago' => true,
                    'estado' => 'Pago'
                ]);
            break;

            case $docTransacao->valorRecebido > $fase->valorFase:
                Fase::where('idFase', $fase->idFase)
                ->update([
                    'verificacaoPago' => true,
                    'estado' => 'Crédito'
                ]);
            break;

            case $docTransacao->valorRecebido < $fase->valorFase && $docTransacao->fase->dataVencimento < Carbon::now():
                Fase::where('idFase', $fase->idFase)
                ->update(['estado' => 'Dívida']);
            break;

            case $docTransacao->valorRecebido < $fase->valorFase && $docTransacao->fase->dataVencimento > Carbon::now():
                Fase::where('idFase', $fase->idFase)
                ->update(['estado' => 'Pendente']);
            break;
        }

        event(new StoreCharge($product));
        return redirect()->route('charges.listfases', $product)->with('success', 'Estado da cobrança alterado com sucesso!');
      }else{
        abort(403);
      }
    }

    public function edit(Produto $product, Fase $fase, DocTransacao $docTransacao)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null){
            $contas = Conta::all();
            return view('charges.edit', compact('product', 'fase', 'docTransacao', 'contas'));
        }else{
            abort(403);
        }
    }

    public function update(UpdateChargeRequest $requestCharge, Produto $product, DocTransacao $docTransacao)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null){
            $fields = $requestCharge->validated();
            $oldFile = $docTransacao->comprovativoPagamento;
            $docTransacao->fill($fields);
            $docTransacao->valorRecebido = str_replace(',', '.', $docTransacao->valorRecebido);

            if($requestCharge->hasFile('comprovativoPagamento')) {
                $file = $requestCharge->file('comprovativoPagamento');
                $filename = post_slug($docTransacao->descricao).'-comprovativo-'.$docTransacao->idDocTransacao.'.'.$file->getClientOriginalExtension();
                Storage::disk('public')->delete('comprovativos-pagamento/'.$oldFile);
                Storage::disk('public')->putFileAs('comprovativos-pagamento/', $file, $filename);
                $docTransacao->comprovativoPagamento = $filename;
            }

        $docTransacao->save();

        if ($docTransacao->valorRecebido == $docTransacao->fase->valorFase) {
            Fase::where('idFase', $docTransacao->fase->idFase)->update([
                'verificacaoPago' => true,
                'estado' => 'Pago',
            ]);
        }elseif ($docTransacao->valorRecebido > $docTransacao->fase->valorFase) {
            Fase::where('idFase', $docTransacao->fase->idFase)->update([
                'verificacaoPago' => true,
                'estado' => 'Crédito',
            ]);
        }elseif ($docTransacao->valorRecebido < $docTransacao->fase->valorFase && $docTransacao->fase->dataVencimento < Carbon::now()) {
            Fase::where('idFase', $docTransacao->fase->idFase)->update([
                'verificacaoPago' => false,
                'estado' => 'Dívida',
            ]);
        }elseif ($docTransacao->valorRecebido < $docTransacao->fase->valorFase && $docTransacao->fase->dataVencimento > Carbon::now()) {
            Fase::where('idFase', $docTransacao->fase->idFase)->update([
                'verificacaoPago' => false,
                'estado' => 'Pendente',
            ]);
        }

        event(new StoreCharge($product));
        return redirect()->route('charges.listfases', $product)->with('success', 'Cobrança editado com sucesso!');
      }else{
        abort(403);
      }
    }

    public function download(DocTransacao $docTransacao)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){
            return Storage::disk('public')->download('comprovativos-pagamento/'.$docTransacao->comprovativoPagamento);
        }else{
            abort(403);
        }
    }
}
