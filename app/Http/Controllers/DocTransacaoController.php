<?php

namespace App\Http\Controllers;

use App\DocTransacao;
use App\Fase;
use App\Conta;
use App\Http\Requests\UpdateDocumentoRequest;
use App\Http\Requests\StoreDocumentoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DocTransacaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function create(Fase $fase)
    {
        $documento = new DocTransacao;
        $tipoPAT = 'Transacao';
        $tipo = 'Transacao';
        $Contas = Conta::all();
        return view('documentos.add',compact('fase','tipoPAT','tipo','documento','Contas'));
    }

    public function store(StoreDocumentoRequest $request,Fase $fase)
    {
        $documento = new DocTransacao;

        $fields = $request->all();
        $documento->descricao=$fields['descricao'];

        if($fields['valorRecebido'] && $fields['valorRecebido']!=0){
            $documento->valorRecebido=$fields['valorRecebido'];
            $documento->verificacao = true;
        }else{
            $documento->verificacao = false;
        }

        $documento->tipoPagamento=$fields['tipoPagamento'];
        $documento->dataOperacao=$fields['dataOperacao'];
        $documento->dataRecebido=$fields['dataRecebido'];
        $documento->observacoes=$fields['observacoes'];
        $documento->idConta=$fields['idConta'];

        $source = null;

        $documento->comprovativoPagamento = $source;
        $documento->idFase = $fase->idFase;
        $documento->save();


        if($fields['img_doc']) {
            $ficheiro = $fields['img_doc'];
            $nomeficheiro = 'cliente_'.$fase->produto->cliente->idCliente.'_fase_'.$fase->idFase.'_documento_transacao_'.$documento->idDocTransacao.'.'.$ficheiro->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('comprovativos-pagamento/', $ficheiro, $nomeficheiro);
            /* $source = 'client-documents/'.$fase->produto->cliente->idCliente.'/'.$nomeficheiro; */
        }

        $documento->comprovativoPagamento = $nomeficheiro;
        $documento->save();

        return redirect()->route('produtos.show',$fase->produto)->with('success', 'Transação adicionado com sucesso');
    }

    public function edit(DocTransacao $documento)
    {
        $tipoPAT = 'Transacao';
        $tipo = 'Transacao';
        $Contas = Conta::all();
        return view('documentos.edit', compact('documento','tipo','tipoPAT','Contas'));
    }

    public function update(UpdateDocumentoRequest $request, DocTransacao $documento)
    {
        $fields = $request->all();
        $documento->descricao=$fields['descricao'];

        if($fields['valorRecebido'] && $fields['valorRecebido']!=0){
            $documento->valorRecebido=$fields['valorRecebido'];
            $documento->verificacao = true;
        }else{
            $documento->verificacao = false;
        }

        $documento->tipoPagamento=$fields['tipoPagamento'];
        $documento->dataOperacao=$fields['dataOperacao'];
        $documento->dataRecebido=$fields['dataRecebido'];
        $documento->observacoes=$fields['observacoes'];
        $documento->idConta=$fields['idConta'];

        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null){
            $documento->verificacao = true;
        }else{
            $documento->verificacao = false;
        }
        $source = null;

        if(array_key_exists('img_doc',$fields)){
            if($fields['img_doc']) {
                $ficheiro = $fields['img_doc'];
                $nomeficheiro = 'cliente_'.$fase->produto->cliente->idCliente.'_fase_'.$fase->idFase.'_documento_transacao_'.$documento->idDocTransacao.'.'.$ficheiro->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('comprovativos-pagamento/', $ficheiro, $nomeficheiro);
                $documento->comprovativoPagamento = $nomeficheiro;
            }
        }

        $documento->save();
        return redirect()->route('produtos.show',$documento->fase->produto)->with('success', 'Dados da Transação editados com sucesso');
    }

    public function destroy(DocTransacao $documento)
    {
        $documento->delete();
        return redirect()->route('produtos.show',$documento->fase->produto)->with('success', 'Transação eliminada com sucesso');
    }
}
