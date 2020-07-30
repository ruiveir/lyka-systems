<?php

namespace App\Http\Controllers;

use App\DocAcademico;
use App\DocNecessario;
use App\Fase;
use App\Produto;
use App\Cliente;
use App\Http\Requests\UpdateDocumentoRequest;
use App\Http\Requests\StoreDocumentoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DocAcademicoController extends Controller
{

    /**
    * Display the specified resource.
    *
    * @param  \App\Cliente  $client
    * @return \Illuminate\Http\Response
    */
    public function create(Fase $fase, DocNecessario $docnecessario)
    {
        $produts = null;
        $permissao = false;
        if(Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null && Auth()->user()->agente->tipo == 'Agente'){
            $produts = Produto::whereRaw('idAgente = '.Auth()->user()->idAgente.' and idCliente = '.$client->idCliente)->get();
        }elseif(Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null && Auth()->user()->agente->tipo == 'Subagente'){
            $produts = Produto::whereRaw('idSubAgente = '.Auth()->user()->idAgente.' and idCliente = '.$client->idCliente)->get();
        }
        if($produts){
            $permissao = true;
        }

        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->email != "admin@test.com")||
            (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)|| $permissao){

            $documento = new DocAcademico;
            $tipoPAT = $docnecessario->tipo;
            $tipo = $docnecessario->tipoDocumento;

            return view('documentos.add',compact('fase','tipoPAT','tipo','documento', 'docnecessario'));
        }else{
            abort(401);
        }
    }




    /***********************************************************************//*
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    * @param  \App\User  $user
    */
    public function store(StoreDocumentoRequest $request,Fase $fase,DocNecessario $docnecessario){

        $produts = null;
        $permissao = false;
        if(Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null && Auth()->user()->agente->tipo == 'Agente'){
            $produts = Produto::whereRaw('idAgente = '.Auth()->user()->idAgente.' and idCliente = '.$client->idCliente)->get();
        }elseif(Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null && Auth()->user()->agente->tipo == 'Subagente'){
            $produts = Produto::whereRaw('idSubAgente = '.Auth()->user()->idAgente.' and idCliente = '.$client->idCliente)->get();
        }
        if($produts){
            $permissao = true;
        }

        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->email != "admin@test.com")||
            (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)|| $permissao){

            $fields = $request->all();
            $infoDoc = null;

            for($i=1;$i<=500;$i++){
                if(array_key_exists('nome-campo'.$i,$fields)){
                    if($fields['nome-campo'.$i]){
                        $infoDoc[$fields['nome-campo'.$i]] = $fields['valor-campo'.$i];
                    }
                }else{
                    break;
                }
            }

            $documento = new DocAcademico;

            if($infoDoc){
                $documento->info = json_encode($infoDoc);
            }else{
                return redirect()->back()->withErrors(['message'=>$docnecessario->tipoDocumento.' tem de conter no minimo 1 campo']);
            }


            $documento->tipo=$docnecessario->tipoDocumento;
            if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->email != "admin@test.com"){
                $documento->verificacao = true;
            }else{
                $documento->verificacao = false;
            }
            $documento->nome = $fields['nome'];
            $documento->idCliente = $fase->produto->cliente->idCliente;
            $documento->idFase = $fase->idFase;

            $source = null;

            if($fields['img_doc']) {
                $ficheiro = $fields['img_doc'];
                $tipoDoc = str_replace(".","_",str_replace(" ","",$documento->tipo));
                $nomeficheiro = 'cliente_'.$fase->produto->cliente->idCliente.'_fase_'.$fase->idFase.'_documento_academico_'.$tipoDoc.'.'.$ficheiro->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('client-documents/'.$fase->produto->cliente->idCliente.'/', $ficheiro, $nomeficheiro);
                /* $source = 'client-documents/'.$fase->produto->cliente->idCliente.'/'.$nomeficheiro; */
            }
            $documento->imagem = $nomeficheiro;
            $documento->save();

            return redirect()->route('produtos.show',$fase->produto)->with('success', $docnecessario->tipoDocumento.' adicionado com sucesso');
        }else{
            abort(401);
        }
    }




    /**
    * Display the specified resource.
    *
    * @param  \App\Cliente  $client
    * @return \Illuminate\Http\Response
    */
    public function createFromClient(StoreDocumentoRequest $request, Cliente $client)
    {
        $produts = null;
        $permissao = false;
        if(Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null && Auth()->user()->agente->tipo == 'Agente'){
            $produts = Produto::whereRaw('idAgente = '.Auth()->user()->idAgente.' and idCliente = '.$client->idCliente)->get();
        }elseif(Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null && Auth()->user()->agente->tipo == 'Subagente'){
            $produts = Produto::whereRaw('idSubAgente = '.Auth()->user()->idAgente.' and idCliente = '.$client->idCliente)->get();
        }
        if($produts){
            $permissao = true;
        }

        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->email != "admin@test.com")||
            (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)|| $permissao){

            $fields = $request->all();

            $documento = new DocAcademico;
            $tipoPAT = "Academico";
            $docnome = $fields['NomeDocumentoAcademico'];
            $tipo = $docnome;
            $fase = null;

            return view('documentos.add',compact('fase','tipoPAT','tipo','documento','docnome','client'));
        }else{
            abort(401);
        }
    }




    /***********************************************************************//*
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    * @param  \App\User  $user
    */
    public function storeFromClient(StoreDocumentoRequest $request, Cliente $client, String $docnome){

        $produts = null;
        $permissao = false;
        if(Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null && Auth()->user()->agente->tipo == 'Agente'){
            $produts = Produto::whereRaw('idAgente = '.Auth()->user()->idAgente.' and idCliente = '.$client->idCliente)->get();
        }elseif(Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null && Auth()->user()->agente->tipo == 'Subagente'){
            $produts = Produto::whereRaw('idSubAgente = '.Auth()->user()->idAgente.' and idCliente = '.$client->idCliente)->get();
        }
        if($produts){
            $permissao = true;
        }

        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->email != "admin@test.com")||
            (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)|| $permissao){

            $fields = $request->all();
            $infoDoc = null;

            for($i=1;$i<=500;$i++){
                if(array_key_exists('nome-campo'.$i,$fields)){
                    if($fields['nome-campo'.$i]){
                        $infoDoc[$fields['nome-campo'.$i]] = $fields['valor-campo'.$i];
                    }
                }else{
                    break;
                }
            }

            $documento = new DocAcademico;
            $documento->idCliente = $client->idCliente;
            $documento->verificacao = true;
            if($infoDoc){
                $documento->info = json_encode($infoDoc);
            }else{
                return redirect()->back()->withErrors(['message'=>$docnome.' tem de conter no minimo 1 campo']);
            }


            $documento->tipo=$docnome;
            if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->email != "admin@test.com"){
                $documento->verificacao = true;
            }else{
                $documento->verificacao = false;
            }
            $documento->nome = $fields['nome'];
            $documento->idCliente = $client->idCliente;

            $source = null;

            if($fields['img_doc']) {
                $ficheiro = $fields['img_doc'];
                $tipoDoc = str_replace(".","_",str_replace(" ","",$documento->tipo));
                $nomeficheiro = 'cliente_'.$client->idCliente.'_documento_academico_'.$tipoDoc.'.'.$ficheiro->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('client-documents/'.$client->idCliente.'/', $ficheiro, $nomeficheiro);
                /* $source = 'client-documents/'.$fase->produto->cliente->idCliente.'/'.$nomeficheiro; */
            }
            $documento->imagem = $nomeficheiro;
            $documento->save();

            return redirect()->route('clients.show',$client)->with('success', $docnome.' adicionado com sucesso');
        }else{
            abort(401);
        }
    }



    public function verify(DocAcademico $documento)
    {
        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->email != "admin@test.com")){
            $infoDoc = (array)json_decode($documento->info);
            $infoKeys = array_keys($infoDoc);
            $tipoPAT = 'Academico';
            $tipo = $documento->tipo;
            return view('documentos.verify',compact('documento','infoDoc','infoKeys','tipo','tipoPAT'));
        }else{
            abort(401);
        }
    }



    public function verifica(DocAcademico $documento)
    {
        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->email != "admin@test.com")){
            $documento->verificacao = true;
            $documento->save();
            return redirect()->route('produtos.show',$documento->fase->produto);
        }else{
            abort(401);
        }
    }





    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Cliente  $client
    * @return \Illuminate\Http\Response
    */
    public function edit(DocAcademico $documento)
    {
        $produts = null;
        $permissao = false;
        if(Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null && Auth()->user()->agente->tipo == 'Agente'){
            $produts = Produto::whereRaw('idAgente = '.Auth()->user()->idAgente.' and idCliente = '.$client->idCliente)->get();
        }elseif(Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null && Auth()->user()->agente->tipo == 'Subagente'){
            $produts = Produto::whereRaw('idSubAgente = '.Auth()->user()->idAgente.' and idCliente = '.$client->idCliente)->get();
        }
        if($produts){
            $permissao = true;
        }

        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->email != "admin@test.com")||
            (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)|| $permissao){

            $infoDoc = (array)json_decode($documento->info);
            $infoKeys = array_keys($infoDoc);
            $tipoPAT = 'Academico';
            $tipo = $documento->tipo;

            return view('documentos.edit', compact('documento','infoDoc','infoKeys','tipo','tipoPAT'));
        }else{
            abort(401);
        }
    }



    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Cliente  $user
    * @return \Illuminate\Http\Response
    */

    public function update(UpdateDocumentoRequest $request, DocAcademico $documento)
    {
        $produts = null;
        $permissao = false;
        if(Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null && Auth()->user()->agente->tipo == 'Agente'){
            $produts = Produto::whereRaw('idAgente = '.Auth()->user()->idAgente.' and idCliente = '.$client->idCliente)->get();
        }elseif(Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null && Auth()->user()->agente->tipo == 'Subagente'){
            $produts = Produto::whereRaw('idSubAgente = '.Auth()->user()->idAgente.' and idCliente = '.$client->idCliente)->get();
        }
        if($produts){
            $permissao = true;
        }

        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->email != "admin@test.com")||
            (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)|| $permissao){

            $fields = $request->all();
            $infoDoc = null;

            for($i=1;$i<=500;$i++){
                if(array_key_exists('nome-campo'.$i,$fields)){
                    if($fields['nome-campo'.$i]){
                        $infoDoc[$fields['nome-campo'.$i]] = $fields['valor-campo'.$i];
                    }
                }else{
                    break;
                }
            }


            if($infoDoc){
                $documento->info = json_encode($infoDoc);
            }else{
                return redirect()->back()->withErrors(['message'=>$documento->tipo.' tem de conter no minimo 1 campo']);
            }

            if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->email != "admin@test.com"){
                $documento->verificacao = true;
            }else{
                $documento->verificacao = false;
            }
            $documento->nome = $fields['nome'];

            if(array_key_exists('img_doc',$fields)){
                $source = null;

                if($fields['img_doc']) {
                    $ficheiro = $fields['img_doc'];
                    $tipoDoc = str_replace(".","_",str_replace(" ","",$documento->tipo));
                    $nomeficheiro = 'cliente_'.$fase->produto->cliente->idCliente.'_fase_'.$fase->idFase.'_documento_academico_'.$tipoDoc.'.'.$ficheiro->getClientOriginalExtension();
                    Storage::disk('public')->putFileAs('client-documents/'.$fase->produto->cliente->idCliente.'/', $ficheiro, $nomeficheiro);
/*                     $source = 'client-documents/'.$fase->produto->cliente->idCliente.'/'.$nomeficheiro; */
                }
                $documento->imagem = $nomeficheiro;
            }
            $documento->save();
            return redirect()->route('produtos.show',$documento->fase->produto)->with('success', 'Dados do '.$documento->tipo.' editados com sucesso');
        }else{
            abort(401);
        }

    }






    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Cliente  $client
    * @return \Illuminate\Http\Response
    */

    public function destroy(DocAcademico $documento)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->email != "admin@test.com"){
            $tipo = $documento->tipo;
            $documento->delete();

            return redirect()->route('produtos.show',$documento->fase->produto)->with('success', $tipo.' eliminado com sucesso');
        }else{
            abort(401);
        }
    }
}
