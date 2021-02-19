<?php

namespace App\Http\Controllers;

use App\Fase;
use App\Cliente;
use App\Produto;
use App\DocPessoal;
use App\DocNecessario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreDocumentoRequest;
use App\Http\Requests\UpdateDocumentoRequest;

class DocPessoalController extends Controller
{
    public function create(Fase $fase, DocNecessario $docnecessario)
    {
        $produts = null;
        $permissao = false;
        if (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null && Auth()->user()->agente->tipo == 'Agente') {
            $produts = Produto::whereRaw('idAgente = '.Auth()->user()->idAgente.' and idCliente = '.$fase->produto->cliente->idCliente)->get();
        } elseif (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null && Auth()->user()->agente->tipo == 'Subagente') {
            $produts = Produto::whereRaw('idSubAgente = '.Auth()->user()->idAgente.' and idCliente = '.$fase->produto->cliente->idCliente)->get();
        }
        if ($produts) {
            $permissao = true;
        }

        if ((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)||
            (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)|| $permissao) {
            $documento = new DocPessoal;
            $tipoPAT = $docnecessario->tipo;
            $tipo = $docnecessario->tipoDocumento;

            return view('documentos.add', compact('fase', 'tipoPAT', 'tipo', 'documento', 'docnecessario'));
        } else {
            abort(403);
        }
    }

    public function createFromClient(StoreDocumentoRequest $request, Cliente $client)
    {
        $produts = null;
        $permissao = false;
        if (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null && Auth()->user()->agente->tipo == 'Agente') {
            $produts = Produto::whereRaw('idAgente = '.Auth()->user()->idAgente.' and idCliente = '.$client->idCliente)->get();
        } elseif (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null && Auth()->user()->agente->tipo == 'Subagente') {
            $produts = Produto::whereRaw('idSubAgente = '.Auth()->user()->idAgente.' and idCliente = '.$client->idCliente)->get();
        }
        if ($produts) {
            $permissao = true;
        }

        if ((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)||
            (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)|| $permissao) {
            $fields = $request->all();
            $documento = new DocPessoal;
            $tipoPAT = "Pessoal";
            $docnome = $fields['NomeDocumentoPessoal'];
            $tipo = $docnome;
            $fase = null;

            return view('documentos.add', compact('fase', 'tipoPAT', 'tipo', 'documento', 'docnome', 'client'));
        } else {
            abort(403);
        }
    }

    public function storeFromClient(StoreDocumentoRequest $request, Cliente $client, String $docnome)
    {
        $produts = null;
        $permissao = false;
        if (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null && Auth()->user()->agente->tipo == 'Agente') {
            $produts = Produto::whereRaw('idAgente = '.Auth()->user()->idAgente.' and idCliente = '.$client->idCliente)->get();
        } elseif (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null && Auth()->user()->agente->tipo == 'Subagente') {
            $produts = Produto::whereRaw('idSubAgente = '.Auth()->user()->idAgente.' and idCliente = '.$client->idCliente)->get();
        }
        if ($produts) {
            $permissao = true;
        }

        if ((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)||
            (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)|| $permissao) {
            $fields = $request->all();
            $infoDoc = null;
            for ($i=1;$i<=500;$i++) {
                if (array_key_exists('nome-campo'.$i, $fields)) {
                    if ($fields['nome-campo'.$i]) {
                        $infoDoc[$fields['nome-campo'.$i]] = $fields['valor-campo'.$i];
                    }
                } else {
                    break;
                }
            }

            $documento = new DocPessoal;
            $documento->idCliente = $client->idCliente;

            $documento->verificacao = true;
            if ($infoDoc) {
                $documento->info = json_encode($infoDoc);
            } else {
                $documento->info = NULL;
            }

            $documento->tipo=$docnome;
            if (array_key_exists('dataValidade', $fields)) {
                $documento->dataValidade = date("Y-m-d", strtotime($fields['dataValidade'].'-1'));
            }
            if (Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null) {
                $documento->verificacao = true;
            } else {
                $documento->verificacao = false;
            }

            $source = null;

            if ($fields['img_doc']) {
                $ficheiro = $fields['img_doc'];
                $tipoDoc = str_replace(".", "_", str_replace(" ", "", $documento->tipo));
                $nomeficheiro = 'cliente_'.$client->idCliente.'_documento_pessoal_'.$tipoDoc.'.'.$ficheiro->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('client-documents/'.$client->idCliente.'/', $ficheiro, $nomeficheiro);
            }
            $documento->imagem = $nomeficheiro;
            $documento->save();

            return redirect()->route('clients.show', $client)->with('success', 'Documento "'.$docnome.'" adicionado com sucesso!');
        } else {
            abort(403);
        }
    }

    public function show(DocPessoal $documento)
    {
        if ((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)) {
            $infoDoc = (array)json_decode($documento->info);
            $infoKeys = array_keys($infoDoc);
            $tipoPAT = 'Pessoal';
            $tipo = $documento->tipo;
            return view('documentos.show', compact('documento', 'infoDoc', 'infoKeys', 'tipo', 'tipoPAT'));
        } else {
            abort(403);
        }
    }

    public function store(StoreDocumentoRequest $request, Fase $fase, DocNecessario $docnecessario)
    {
        $produts = null;
        $permissao = false;
        if (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null && Auth()->user()->agente->tipo == 'Agente') {
            $produts = Produto::whereRaw('idAgente = '.Auth()->user()->idAgente.' and idCliente = '.$fase->produto->cliente->idCliente)->get();
        } elseif (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null && Auth()->user()->agente->tipo == 'Subagente') {
            $produts = Produto::whereRaw('idSubAgente = '.Auth()->user()->idAgente.' and idCliente = '.$fase->produto->cliente->idCliente)->get();
        }
        if ($produts) {
            $permissao = true;
        }

        if ((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)||
            (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)|| $permissao) {
            $fields = $request->all();
            $infoDoc = null;
            if (strtolower($docnecessario->tipoDocumento) == "passaporte") {
                $infoDoc['numPassaporte'] = $fields['numPassaporte'];
                $infoDoc['passaportPaisEmi'] = $fields['passaportPaisEmi'];
                $infoDoc['dataValidPP'] = date("Y-m-d", strtotime($fields['dataValidPP'].'-1'));
                $infoDoc['localEmissaoPP'] = $fields['localEmissaoPP'];
            }
            for ($i=1;$i<=500;$i++) {
                if (array_key_exists('nome-campo'.$i, $fields)) {
                    if ($fields['nome-campo'.$i]) {
                        $infoDoc[$fields['nome-campo'.$i]] = $fields['valor-campo'.$i];
                    }
                } else {
                    break;
                }
            }

            $documento = new DocPessoal;

            if ($infoDoc) {
                $documento->info = json_encode($infoDoc);
            } else {
                $documento->info = NULL;
            }

            $documento->tipo=$docnecessario->tipoDocumento;
            if (array_key_exists('dataValidade', $fields)) {
                $documento->dataValidade = date("Y-m-d", strtotime($fields['dataValidade'].'-1'));
            }
            if (Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null) {
                $documento->verificacao = true;
            } else {
                $documento->verificacao = false;
            }
            $documento->idCliente = $fase->produto->cliente->idCliente;
            $documento->idFase = $fase->idFase;



            $source = null;

            if ($fields['img_doc']) {
                $ficheiro = $fields['img_doc'];
                $tipoDoc = str_replace(".", "_", str_replace(" ", "", $documento->tipo));
                $nomeficheiro = 'cliente_'.$fase->produto->cliente->idCliente.'_fase_'.$fase->idFase.'_documento_pessoal_'.$tipoDoc.'.'.$ficheiro->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('client-documents/'.$fase->produto->cliente->idCliente.'/', $ficheiro, $nomeficheiro);
            }
            $documento->imagem = $nomeficheiro;
            $documento->save();

            return redirect()->route('clients.show', $fase->client)->with('success', 'Documento '.$docnecessario->tipoDocumento.' adicionado com sucesso!');
        } else {
            abort(403);
        }
    }

    public function verify(DocPessoal $documento)
    {
        if ((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)) {
            $infoDoc = (array)json_decode($documento->info);
            $infoKeys = array_keys($infoDoc);
            $tipoPAT = 'Pessoal';
            $tipo = $documento->tipo;
            return view('documentos.verify', compact('documento', 'infoDoc', 'infoKeys', 'tipo', 'tipoPAT'));
        } else {
            abort(403);
        }
    }

    public function verifica(DocPessoal $documento)
    {
        if ((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)) {
            $documento->verificacao = true;
            $documento->save();
            return redirect()->route('produtos.show', $documento->fase->produto);
        } else {
            abort(403);
        }
    }

    public function edit(DocPessoal $documento, Cliente $client)
    {
        $produts = null;
        $permissao = false;
        if (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null && Auth()->user()->agente->tipo == 'Agente') {
            $produts = Produto::whereRaw('idAgente = '.Auth()->user()->idAgente.' and idCliente = '.$documento->cliente->idCliente)->get();
        } elseif (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null && Auth()->user()->agente->tipo == 'Subagente') {
            $produts = Produto::whereRaw('idSubAgente = '.Auth()->user()->idAgente.' and idCliente = '.$documento->cliente->idCliente)->get();
        }
        if ($produts) {
            $permissao = true;
        }

        if ((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)||
            (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)|| $permissao) {
            $infoDoc = (array)json_decode($documento->info);
            $infoKeys = array_keys($infoDoc);
            $tipoPAT = 'Pessoal';
            $tipo = $documento->tipo;

            return view('documentos.edit', compact('documento', 'infoDoc', 'infoKeys', 'tipo', 'tipoPAT', 'client'));
        } else {
            abort(403);
        }
    }

    public function update(UpdateDocumentoRequest $request, DocPessoal $documento)
    {
        $produts = null;
        $permissao = false;
        if (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null && Auth()->user()->agente->tipo == 'Agente') {
            $produts = Produto::whereRaw('idAgente = '.Auth()->user()->idAgente.' and idCliente = '.$documento->cliente->idCliente)->get();
        } elseif (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null && Auth()->user()->agente->tipo == 'Subagente') {
            $produts = Produto::whereRaw('idSubAgente = '.Auth()->user()->idAgente.' and idCliente = '.$documento->cliente->idCliente)->get();
        }
        if ($produts) {
            $permissao = true;
        }

        if ((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)||
            (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)|| $permissao) {
            $fields = $request->all();

            $infoDoc = null;
            if (strtolower($documento->tipo) == "passaporte") {
                $infoDoc['numPassaporte'] = $fields['numPassaporte'];
                $infoDoc['dataValidPP'] = $fields['dataValidPP'];
                $infoDoc['passaportPaisEmi'] = $fields['passaportPaisEmi'];
                $infoDoc['localEmissaoPP'] = $fields['localEmissaoPP'];
            }

            for ($i=1;$i<=500;$i++) {
                if (array_key_exists('nome-campo'.$i, $fields)) {
                    if ($fields['nome-campo'.$i]) {
                        $infoDoc[$fields['nome-campo'.$i]] = $fields['valor-campo'.$i];
                    }
                } else {
                    break;
                }
            }

            if ($infoDoc) {
                $documento->info = json_encode($infoDoc);
            }else {
                $documento->info = NULL;
            }

            if (array_key_exists('dataValidade', $fields)) {
                $documento->dataValidade = date("Y-m-d", strtotime($fields['dataValidade'].'-1'));
            }
            if (Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null) {
                $documento->verificacao = true;
            } else {
                $documento->verificacao = false;
            }
            if (array_key_exists('img_doc', $fields)) {
                $source = null;

                if ($fields['img_doc']) {
                    $ficheiro = $fields['img_doc'];
                    $tipoDoc = str_replace(".", "_", str_replace(" ", "", $documento->tipo));
                    $nomeficheiro = 'cliente_'.$fase->produto->cliente->idCliente.'_fase_'.$fase->idFase.'_documento_pessoal_'.$tipoDoc.'.'.$ficheiro->getClientOriginalExtension();
                    Storage::disk('public')->putFileAs('client-documents/'.$fase->produto->cliente->idCliente.'/', $ficheiro, $nomeficheiro);
                    $documento->imagem = $nomeficheiro;
                }
            }
            $documento->save();
            return redirect()->route('clients.show', $documento->cliente)->with('success', 'Dados do documento "'.$documento->tipo.'" editados com sucesso!');
        } else {
            abort(403);
        }
    }

    public function destroy(DocPessoal $documento)
    {
        if (Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null) {
            $documento->delete();
            Storage::disk('public')->delete('client-documents/'.$documento->idCliente.'/'.$documento->imagem);
            return redirect()->route('clients.show', $documento->idCliente)->with('success', 'Documento "'.$tipo.'" eliminado com sucesso');
        } else {
            abort(403);
        }
    }
}
