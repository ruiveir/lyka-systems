<?php

namespace App\Http\Controllers;

use App\Fase;
use App\Conta;
use App\Produto;
use App\DocTransacao;
use App\Responsabilidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreChargeRequest;
use App\Http\Requests\UpdateChargeRequest;

class ChargesController extends Controller
{
    public function index()
    {
      if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)||
        (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)||
        (Auth()->user()->tipo == 'cliente' && Auth()->user()->idCliente != null)){
        $products = null;
        $fasesPendentes = null;
        $fasesPagas = null;
        $fasesDivida = null;
        $numberProducts = null;

        if(Auth()->user()->tipo == 'admin'){

          $products = Produto::all();
          /*$fasesPendentes = Fase::where('estado', '=', 'Pendente')->get();
          $fasesPagas = Fase::where('estado', '=', 'Pago')->get();
          $fasesDivida = Fase::where('estado', '=', 'Dívida')->get();
          $numberProducts = Produto::where('valorTotal', '!=', '0')->get();*/

        }elseif(Auth()->user()->tipo == 'agente'&&Auth()->user()->agente->tipo=="Agente"){

          $products = Produto::where('idAgente','=',Auth()->user()->idAgente);

        }elseif(Auth()->user()->tipo == 'agente'&&Auth()->user()->agente->tipo=="Subagente"){

          $products = Produto::where('idSubAgente','=',Auth()->user()->idAgente);

        }else{

          $products = Produto::where('idCliente','=',Auth()->user()->idCliente);

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

        return view('charges.list', compact('products', 'numberProducts', 'fasesPendentes', 'fasesPagas', 'fasesDivida'));
      }else{
        abort(401);
      }
    }

    public function show(DocTransacao $docTrasancao, Fase $fase, Produto $product)
    {
      if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)||
        (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)||
        (Auth()->user()->tipo == 'cliente' && Auth()->user()->idCliente != null)){
        $docTrasancao = DocTransacao::all();
        $fases = Fase::where('idProduto', '=', $product->idProduto)
        ->orderBy('verificacaoPago', 'ASC')
        ->orderBy('dataVencimento', 'ASC')
        ->get();
        return view('charges.show', compact('product', 'fases', 'docTrasancao'));
      }else{
        abort(401);
      }
    }

    public function showcharge(Produto $product, Fase $fase, Conta $contas)
    {
      if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null){
        $contas = Conta::all();
        $docTrasancao = DocTransacao::where('idFase', '=', $fase->idFase)->get();
        return view('charges.showcharge', compact('product', 'fase', 'docTrasancao', 'contas'));
      }else{
        abort(401);
      }
    }

    public function store(Request $request, StoreChargeRequest $requestCharge, Produto $product, Fase $fase)
    {
      if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null){
        $docTrasancao = new DocTransacao;
        $fields = $requestCharge->validated();
        $docTrasancao->fill($fields);

        $value = number_format((float) $docTrasancao->valorRecebido,2 ,'.' ,'');
        $docTrasancao->valorRecebido = $value;

        $idConta = $request->input('conta');
        $docTrasancao->idConta = $idConta;

        $docTrasancao->descricao = 'Cobrança da '.$fase->descricao;
        $docTrasancao->idFase = $fase->idFase;

        $docTrasancao->save();

        if ($requestCharge->hasFile('comprovativoPagamento')) {
            $fileproof = $requestCharge->file('comprovativoPagamento');
            $imgproof = strtolower($docTrasancao->descricao).'_comprovativo_'.$docTrasancao->idDocTransacao.'.' . $fileproof->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('comprovativos-pagamento/', $fileproof, $imgproof);
            $docTrasancao->comprovativoPagamento = $imgproof;
            $docTrasancao->save();
        }

        switch ($docTrasancao->valorRecebido) {
          case $docTrasancao->valorRecebido == $fase->valorFase:
            Fase::where('idFase', '=', $fase->idFase)
            ->update([
              'verificacaoPago' => '1',
              'estado' => 'Pago'
            ]);
            break;

          case $docTrasancao->valorRecebido > $fase->valorFase:
            Fase::where('idFase', '=', $fase->idFase)
            ->update([
              'verificacaoPago' => '1',
              'estado' => 'Crédito'
            ]);
            break;

          case $docTrasancao->valorRecebido < $fase->valorFase:
            Fase::where('idFase', '=', $fase->idFase)
            ->update(['estado' => 'Dívida']);
            break;
        }

        return redirect()->route('charges.show', $product)->with('success', 'Estado da cobrança alterado com sucesso!');
      }else{
        abort(401);
      }
    }

    public function edit(Produto $product, Fase $fase, DocTransacao $document, Conta $contas)
    {
      if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null){
        $contas = Conta::all();
        return view('charges.edit', compact('product', 'fase', 'document', 'contas'));
      }else{
        abort(401);
      }
    }

    public function update(UpdateChargeRequest $requestCharge, Produto $product, DocTransacao $document)
    {
      if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null){
        $fields = $requestCharge->validated();
        $document->fill($fields);

        $value = number_format((float) $document->valorRecebido,2 ,'.' ,'');
        $document->valorRecebido = $value;

        if ($requestCharge->hasFile('comprovativoPagamento')) {
            $fileproof = $requestCharge->file('comprovativoPagamento');
            $imgproof = strtolower(preg_replace('/\s+/', '_', $document->descricao)) . '_comprovativo_'. $document->idDocTransacao .'.' . $fileproof->getClientOriginalExtension();
            if (!empty($document->comprovativoPagamento)) {
                Storage::disk('public')->delete('comprovativos-pagamento/'.$document->comprovativoPagamento);
            }
            Storage::disk('public')->putFileAs('comprovativos-pagamento/', $fileproof, $imgproof);
            $document->comprovativoPagamento = $imgproof;
        }

        $document->save();

        if ($document->valorRecebido >= $document->fase->valorFase) {
          Fase::where('descricao', '=', $document->fase->descricao)->update(['verificacaoPago' => '1']);
        }else {
          Fase::where('descricao', '=', $document->fase->descricao)->update(['verificacaoPago' => '0']);
        }

        return redirect()->route('charges.show', $product)->with('success', 'Estado da cobrança editado com sucesso!');
      }else{
        abort(401);
      }
    }

    public function download(DocTransacao $document)
    {
      if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){
        return Storage::disk('public')->download('comprovativos-pagamento/'.$document->comprovativoPagamento);
      }else{
        abort(401);
      }
    }
}
