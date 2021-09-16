<?php

namespace App\Http\Controllers;

use App\Agente;
use App\Cliente;
use App\Fase;
use App\Fornecedor;
use App\Produto;
use App\ProdutoStock;
use App\Responsabilidade;
use App\Universidade;
use App\RelFornResp;
use App\DocNecessario;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProdutoRequest;
use App\Http\Requests\StoreProdutoRequest;

class ProdutoController extends Controller
{
    public function list($client)
    {
        if (Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null){
            $produtosStock = ProdutoStock::all();
            return view('produtos.list', compact('produtosStock','client'));
        }else{
            abort(403);
        }
    }

    public function create(Cliente $client, ProdutoStock $produtoStock)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null){
            $cliente = $client;
            $produto = new Produto;
            $produto->idCLiente = $cliente->idCliente;
            $produto->tipo = $produtoStock->tipoProduto;
            $produto->descricao = $produtoStock->descricao;
            $produto->anoAcademico = $produtoStock->anoAcademico;
            $Agentes = Agente::where('tipo','=','Agente')->orderBy('nome')->get();
            $SubAgentes = Agente::where('tipo','=','Subagente')->orderBy('nome')->get();
            $Universidades = Universidade::all();
            $Fornecedores = Fornecedor::all();
            $Fases=null;
            $Responsabilidades = null;
            $relacao = new RelFornResp;
            $fasesStock = $produtoStock->faseStock;
            foreach($fasesStock as $faseStock){
                $fase = new Fase;
                $fase->descricao = $faseStock->descricao;
                $Fases[] = $fase;
                $responsabilidade = new Responsabilidade;
                $Responsabilidades[] = $responsabilidade;
            }

            $anosAcademicos = null;
            $anoAtual =  date("Y");

            for($i = 0; $i <= 5; $i++){
                $anosAcademicos[] = ($anoAtual-1+$i)."/".($anoAtual+$i);
            }


            return view('produtos.add',compact('produto','produtoStock','cliente','Agentes','SubAgentes','Universidades','Fases','Responsabilidades','Fornecedores','relacao','anosAcademicos'));
        }else{
            abort(403);
        }
    }

    public function store(StoreProdutoRequest $request, ProdutoStock $produtoStock)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null){
            $fields = $request->all();

            $produto = new Produto;
            $produto->tipo = $fields['tipo'];
            $produto->descricao = $fields['descricao'];
            $produto->anoAcademico = $fields['anoAcademico'];
            $produto->idCliente = $fields['idCliente'];
            $produto->idAgente = $fields['agente'];
            $produto->idUniversidade1 = $fields['uni1'];
            $produto->valorTotal = 0;
            $produto->valorTotalAgente = 0;

            $t=time();
            $produto->create_at == date("Y-m-d",$t);

            $valorProduto = 0;
            $valorTAgente = 0;
            $fasesStock = $produtoStock->faseStock;

            for($i=1;$i<=count($fasesStock->toArray());$i++){
                if($fields['descricao-fase'.$i]!=null){


                    /*if(!$fields['data-fase'.$i]){
                        return redirect()->back()->withErrors(['required' => 'Data vencimento da fase '.$i.' é obrigatória']);
                    }
                    if(!$fields['valor-fase'.$i]){
                        return redirect()->back()->withErrors(['required' => 'Valor da fase '.$i.' é obrigatório']);
                    }
                    if(!$fields['resp-cliente-fase'.$i]){
                        return redirect()->back()->withErrors(['required' => 'pickpocket do cliente na fase '.$i.' é obrigatório']);
                    }
                    if(!$fields['resp-agente-fase'.$i]){
                        return redirect()->back()->withErrors(['required' => 'Valor do agente na fase '.$i.' é obrigatório']);
                    }
                    if(!$fields['resp-uni1-fase'.$i]){
                        return redirect()->back()->withErrors(['required' => 'Valor do agente na fase '.$i.' é obrigatório']);
                    }*/

                    $fase = new Fase;

                    $fase->descricao = $fields['descricao-fase'.$i];
                    $fase->dataVencimento = date("Y-m-d",strtotime($fields['data-fase'.$i]));
                    $fase->valorFase = $fields['valor-fase'.$i];
                    $fase->create_at == date("Y-m-d",$t);


                    $responsabilidade = new Responsabilidade;
                    $valorRelacoes = 0;
                    $responsabilidade->valorCliente = $fields['resp-cliente-fase'.$i];
                    if($fields['resp-data-cliente-fase'.$i]){
                        $responsabilidade->dataVencimentoCliente = date("Y-m-d",strtotime($fields['resp-data-cliente-fase'.$i]));
                    }else{
                        $responsabilidade->dataVencimentoCliente = null;
                    }
                    $responsabilidade->valorAgente = $fields['resp-agente-fase'.$i];
                    if($fields['resp-data-agente-fase'.$i]){
                        $responsabilidade->dataVencimentoAgente = date("Y-m-d",strtotime($fields['resp-data-agente-fase'.$i]));
                    }else{
                        $responsabilidade->dataVencimentoAgente = null;
                    }
                    $responsabilidade->valorUniversidade1 = $fields['resp-uni1-fase'.$i];
                    if($fields['resp-data-uni1-fase'.$i]){
                        $responsabilidade->dataVencimentoUni1 = date("Y-m-d",strtotime($fields['resp-data-uni1-fase'.$i]));
                    }else{
                        $responsabilidade->dataVencimentoUni1 = null;
                    }

                    $responsabilidade->verificacaoPagoCliente = false;
                    $responsabilidade->verificacaoPagoAgente = false;
                    $responsabilidade->verificacaoPagoUni1 = false;

                    $responsabilidade->idCliente = $produto->idCliente;
                    $responsabilidade->idAgente = $produto->idAgente;
                    $responsabilidade->idUniversidade1 = $produto->idUniversidade1;

                    $produto->save();

                    $fase->idProduto = $produto->idProduto;
                    $fase->save();

                    $responsabilidade->idFase = $fase->idFase;
                    $responsabilidade->save();

                    for($numF=1;$numF<=10000;$numF++){
                        if(array_key_exists("fornecedor".$numF."-fase".$i, $fields)){
                            if($fields["fornecedor".$numF."-fase".$i]){
                                $relacao = new RelFornResp;
                                $relacao->idFornecedor = $fields["fornecedor".$numF."-fase".$i];
                                $relacao->idResponsabilidade = $responsabilidade->idResponsabilidade;
                                if($fields["valor-fornecedor".$numF."-fase".$i]){
                                    $relacao->valor = $fields["valor-fornecedor".$numF."-fase".$i];
                                }else{
                                    $relacao->valor = 0;
                                }
                                $relacao->create_at == date("Y-m-d",$t);
                                if($fields["data-fornecedor".$numF."-fase".$i]){
                                    $relacao->dataVencimento = date("Y-m-d",strtotime($fields["data-fornecedor".$numF."-fase".$i]));
                                }else{
                                    $relacao->dataVencimento = null;
                                }
                                $relacao->save();

                                $valorRelacoes = $valorRelacoes + $relacao->valor;
                            }
                        }else{
                            break;
                        }
                    }

                    $docsStock = $fasesStock[$i-1]->docStock;
                    foreach($docsStock as $doc){
                        $documento = new DocNecessario;
                        $documento->tipo = $doc->tipo;
                        $documento->tipoDocumento = $doc->tipoDocumento;
                        $documento->idFase = $fase->idFase;
                        $documento->save();
                    }

                    $valorProduto = $valorProduto + $fase->valorFase;
                    $valorTAgente = $valorTAgente + $responsabilidade->valorAgente;
                }
            }

            $produto->valorTotal = $valorProduto;
            $produto->valorTotalAgente = $valorTAgente;
            $produto->save();

            return redirect()->route('clients.show',$produto->cliente)->with('success', 'Produto criado com sucesso!');
        }else{
            abort(403);
        }
    }

    public function show(Produto $produto)
    {
        $produts = null;
        $permissao = false;
        if(Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null && Auth()->user()->agente->tipo == 'Agente'){
            $produts = Produto::whereRaw('idAgente = '.Auth()->user()->idAgente.' and idCliente = '.$produto->cliente->idCliente)->get();
        }elseif(Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null && Auth()->user()->agente->tipo == 'Subagente'){
            $produts = Produto::whereRaw('idSubAgente = '.Auth()->user()->idAgente.' and idCliente = '.$produto->cliente->idCliente)->get();
        }
        if($produts){
            $permissao = true;
        }

        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)|| $permissao){
            $Fases = $produto->fase;
            $Today = (new DateTime)->format('Y-m-d');
            return view('produtos.show',compact("produto",'Fases','Today'));
        }else{
            abort(403);
        }
    }

    public function edit(Produto $produto)
    {
        $produts = null;
        $permissao = false;
        if(Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null && Auth()->user()->agente->tipo == 'Agente'){
            $produts = Produto::whereRaw('idAgente = '.Auth()->user()->idAgente.' and idCliente = '.$produto->cliente->idCliente)->get();
        }
        if($produts){
            $permissao = true;
        }

        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)|| $permissao ){
            $Fornecedores = Fornecedor::all();
            $Agentes = Agente::where('tipo','=','Agente')->orderBy('nome')->get();
            $SubAgentes = Agente::where('tipo','=','Subagente')->orderBy('nome')->get();
            $Universidades = Universidade::all();
            $relacao = new RelFornResp;
            $relacao->valor=0;
            $fases = $produto->fase;

            $anosAcademicos = null;
            $anoAtual =  date("Y");

            for($i = 0; $i <= 5; $i++){
                $anosAcademicos[] = ($anoAtual-1+$i)."/".($anoAtual+$i);
            }
            return view('produtos.edit', compact('produto','Agentes','SubAgentes','Universidades','fases','Fornecedores','relacao','anosAcademicos'));
        }else{
            abort(403);
        }
    }

    public function update(UpdateProdutoRequest $request, Produto $produto)
    {
        $produts = null;
        $permissao = false;
        if(Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null && Auth()->user()->agente->tipo == 'Agente'){
            $produts = Produto::whereRaw('idAgente = '.Auth()->user()->idAgente.' and idCliente = '.$produto->cliente->idCliente)->get();
        }elseif(Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null && Auth()->user()->agente->tipo == 'Subagente'){
            $produts = Produto::whereRaw('idSubAgente = '.Auth()->user()->idAgente.' and idCliente = '.$produto->cliente->idCliente)->get();
        }
        if($produts){
            $permissao = true;
        }

        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)|| $permissao){

            $fases = $produto->fase;
            $fields = $request->all();
            /*if(!$fields['anoAcademico']){
                return redirect()->back()->withErrors(['required' => 'Ano académico é obrigatório']);
            }
            if(!$fields['agente']){
                return redirect()->back()->withErrors(['required' => 'Agente é obrigatório']);
            }
            if(!$fields['uni1']){
                return redirect()->back()->withErrors(['required' => 'Universidade principal é obrigatório']);
            }*/

            if(!$permissao){
                $produto->tipo = $fields['tipo'];
                $produto->descricao = $fields['descricao'];
                $produto->anoAcademico = $fields['anoAcademico'];
                $produto->idAgente = $fields['agente'];
            }
            if(array_key_exists('subagente', $fields)){
                $produto->idSubAgente = $fields['subagente'];
                $fases = $produto->fase;
                foreach($fases as $fase){
                    $responsabilidade = $fase->responsabilidade;
                    //$responsabilidade->valorSubAgente = 0;
                    $responsabilidade->save();
                }
            }
            if(!$permissao){
                $produto->idUniversidade1 = $fields['uni1'];
                $produto->idUniversidade2 = in_array('uni2', $fields) ? $fields['uni2'] : null;
            }

            $valorProduto = 0;
            $valorTAgente = 0;
            $valorTSubAgente = 0;
            foreach($fases as $fase){

               /* if(!$fields['data-fase'.$fase->idFase]){
                    return redirect()->back()->withErrors(['required' => 'Data vencimento da fase '.$fase->idFase.' é obrigatória']);
                }
                if(!$fields['valor-fase'.$fase->idFase]){
                    return redirect()->back()->withErrors(['required' => 'Valor da fase '.$fase->idFase.' é obrigatório']);
                }
                if(!$fields['resp-cliente-fase'.$fase->idFase]){
                    return redirect()->back()->withErrors(['required' => 'pickpocket do cliente na fase '.$fase->idFase.' é obrigatório']);
                }
                if(!$fields['resp-agente-fase'.$fase->idFase]){
                    return redirect()->back()->withErrors(['required' => 'Valor do agente na fase '.$fase->idFase.' é obrigatório']);
                }
                if(!$fields['resp-uni1-fase'.$fase->idFase]){
                    return redirect()->back()->withErrors(['required' => 'Valor do agente na fase '.$fase->idFase.' é obrigatório']);
                }*/

                if(!$permissao){
                    $fase->descricao = $fields['descricao-fase'.$fase->idFase];
                    $fase->dataVencimento = date("Y-m-d",strtotime($fields['data-fase'.$fase->idFase]));
                    $fase->valorFase = $fields['valor-fase'.$fase->idFase];
                }
                $produto->save();
                $fase->save();

                $responsabilidade = $fase->responsabilidade;

                if(!$permissao){
                    $relacoes = $responsabilidade->relacao;
                    $valorRelacoes = 0;
                    $responsabilidade->valorCliente = $fields['resp-cliente-fase'.$fase->idFase];
                    if($fields['resp-data-cliente-fase'.$fase->idFase]){
                        $responsabilidade->dataVencimentoCliente = date("Y-m-d",strtotime($fields['resp-data-cliente-fase'.$fase->idFase]));
                    }else{
                        $responsabilidade->dataVencimentoCliente = null;
                    }
                    $responsabilidade->verificacaoPagoCliente = false;

                    $valorTotalAgeSubAge = $responsabilidade->valorAgente;
                    $novoValorAgente = null;

                    $responsabilidade->valorAgente = $fields['resp-agente-fase'.$fase->idFase];
                    if($fields['resp-data-agente-fase'.$fase->idFase]){
                        $responsabilidade->dataVencimentoAgente = date("Y-m-d",strtotime($fields['resp-data-agente-fase'.$fase->idFase]));
                    }else{
                        $responsabilidade->dataVencimentoAgente = null;
                    }
                    $responsabilidade->verificacaoPagoAgente = false;
                }
                /*
                if(array_key_exists('resp-subagente-fase'.$fase->idFase, $fields)){
                    if($produto->idSubAgente && $responsabilidade->valorSubAgente != $fields['resp-subagente-fase'.$fase->idFase]){
                        $novoValorAgente = $valorTotalAgeSubAge-$fields['resp-subagente-fase'.$fase->idFase];
                        if($novoValorAgente == 0){
                            $responsabilidade->valorAgente = 0;
                        }elseif($novoValorAgente<0){
                            $responsabilidade->valorAgente = 0;
                            $responsabilidade->valorSubAgente = $valorTotalAgeSubAge;
                        }else{
                            $responsabilidade->valorAgente = $novoValorAgente;
                            $responsabilidade->valorSubAgente = $fields['resp-subagente-fase'.$fase->idFase];
                        }
                        $responsabilidade->verificacaoPagoSubAgente = false;
                    }
                    if($fields['resp-data-subagente-fase'.$fase->idFase]){
                        $responsabilidade->dataVencimentoSubAgente = date("Y-m-d",strtotime($fields['resp-data-subagente-fase'.$fase->idFase]));
                    }else{
                        $responsabilidade->dataVencimentoSubAgente = null;
                    }
                }
                */

                if(!$permissao){
                    if($responsabilidade->valorUniversidade1 != $fields['resp-uni1-fase'.$fase->idFase]){
                        $responsabilidade->valorUniversidade1 = $fields['resp-uni1-fase'.$fase->idFase];
                        if($fields['resp-data-uni1-fase'.$fase->idFase]){
                            $responsabilidade->dataVencimentoUni1 = date("Y-m-d",strtotime($fields['resp-data-uni1-fase'.$fase->idFase]));
                        }else{
                            $responsabilidade->dataVencimentoUni1 = null;
                        }
                        $responsabilidade->verificacaoPagoUni1 = false;
                    }

                    /*
                    if($produto->idUniversidade2 && $responsabilidade->valorUniversidade2 = $fields['resp-uni2-fase'.$fase->idFase]){
                        $responsabilidade->valorUniversidade2 = $fields['resp-uni2-fase'.$fase->idFase];
                        if($fields['resp-data-uni2-fase'.$fase->idFase]){
                            $responsabilidade->dataVencimentoUni2 = date("Y-m-d",strtotime($fields['resp-data-uni2-fase'.$fase->idFase]));
                        }else{
                            $responsabilidade->dataVencimentoUni2 = null;
                        }
                        $responsabilidade->verificacaoPagoUni2 = false;
                    }
                    */
                    $responsabilidade->idCliente = $produto->idCliente;
                    $responsabilidade->idAgente = $produto->idAgente;
                    $responsabilidade->idUniversidade1 = $produto->idUniversidade1;
                    //$responsabilidade->idUniversidade2 = $produto->idUniversidade2;
                }
                //$responsabilidade->idSubAgente = $produto->idSubAgente;


                $responsabilidade->save();

                if(!$permissao){
                    if($relacoes->toArray()){
                        foreach($relacoes as $relacao){
                            $existe = false;
                            for($i=1;$i<=10000;$i++){
                                if(array_key_exists("fornecedor".$i."-fase".$fase->idFase, $fields)){
                                    if($fields["fornecedor".$i."-fase".$fase->idFase]==$relacao->idFornecedor){
                                        if($fields["valor-fornecedor".$i."-fase".$fase->idFase]){
                                            $relacao->valor = $fields["valor-fornecedor".$i."-fase".$fase->idFase];
                                        }else{
                                            $relacao->valor = 0;
                                        }
                                        if($fields["data-fornecedor".$numF."-fase".$i]){
                                            $relacao->dataVencimento = date("Y-m-d",strtotime($fields["data-fornecedor".$numF."-fase".$i]));
                                        }else{
                                            $relacao->dataVencimento = null;
                                        }
                                        $relacao->save();
                                        $existe = true;
                                    }
                                }else{
                                    break;
                                }
                            }
                            if(!$existe){
                                $relacao->delete();
                            }
                        }
                    }

                    for($i=1;$i<=10000;$i++){
                        if(array_key_exists("fornecedor".$i."-fase".$fase->idFase, $fields)){
                            if($fields["fornecedor".$i."-fase".$fase->idFase]){
                                $existe = false;
                                if($relacoes->toArray()){
                                    foreach($relacoes as $relacao){
                                        if($fields["fornecedor".$i."-fase".$fase->idFase]==$relacao->idFornecedor){
                                            $existe = true;
                                        }
                                    }
                                }
                                if(!$existe){
                                    $relacao = new RelFornResp;
                                    $relacao->idFornecedor = $fields["fornecedor".$i."-fase".$fase->idFase];
                                    $relacao->idResponsabilidade = $responsabilidade->idResponsabilidade;
                                    if($fields["valor-fornecedor".$i."-fase".$fase->idFase]){
                                        $relacao->valor = $fields["valor-fornecedor".$i."-fase".$fase->idFase];
                                    }else{
                                        $relacao->valor = 0;
                                    }
                                    $relacao->save();

                                    $valorRelacoes = $valorRelacoes + $relacao->valor;
                                }
                            }
                        }else{
                            break;
                        }
                    }
                }
                $valorProduto = $valorProduto + $fase->valorFase;
                $valorTAgente = $valorTAgente + $responsabilidade->valorAgente;
                $valorTSubAgente = $valorTSubAgente + $responsabilidade->valorSubAgente;
            }

            $produto->valorTotal = $valorProduto;
            $produto->valorTotalAgente = $valorTAgente;
            if($produto->idSubAgente){
                $produto->valorTotalSubAgente = $valorTSubAgente;
            }
            $produto->save();

            return redirect()->route('clients.show',$produto->cliente)->with('success', 'Dados do produto modificados com sucesso');
        }else{
            abort(403);
        }

    }

    public function destroy(Produto $produto)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null){
            $produto->delete();
            $fases = $produto->fase;
            foreach($fases as $fase){
                $responsabilidade = $fase->responsabilidade;
                $responsabilidade->delete();
                $fase->delete();
            }
            return redirect()->route('clients.show',$produto->cliente)->with('success', 'Produto eliminado com sucesso');
        }else{
            abort(403);
        }
    }
}
