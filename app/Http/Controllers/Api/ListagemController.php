<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Cliente;

class ListagemController extends Controller
{

    public function getCountries(String $pais){
        $clientes = Cliente::where('paisNaturalidade','like',$pais)->orderBy('Cidade')->get();
        $cidades = null;
        if($clientes){
            foreach($clientes as $cliente){
                $existe = false;
                if($cidades){
                    foreach($cidades as $cidade){
                        if($cidade == $cliente->cidade){
                            $existe = true;
                        }
                    }
                }
                if(!$existe){
                    $cidades[] = $cliente->cidade;
                }
            }
        }
        return ['results' => $cidades];
    }


    public function getList(String $pesquisa)
    {/*String $pais, String $cidade, Agente $agente, Agente $subagente, Universidade $universidade, String $curso, String $intitutoOrigem, String $atividade*/
        /*if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){/**/
            $result = explode("_", $pesquisa);
            $final=null;
            $Clientes = null;
            foreach($result as $res){
                $explode = explode("-", $res);
                if($explode[1] == 'null'){
                    $final[$explode[0]] = null;
                }else{
                    $final[$explode[0]] = $explode[1];
                }
            }
            $where = null;
            $join = false;
            if($final['pais']){
                if($where){
                    $where = $where.' and ';
                }
                $where = $where."cliente.paisNaturalidade like '".$final['pais']."'";
            }
            if($final['cidade']){
                if($where){
                    $where = $where.' and ';
                }
                $where = $where."cliente.cidade like '".$final['cidade']."'";
            }
            if($final['agente']){
                if($where){
                    $where = $where.' and ';
                }
                $where = $where."(cliente.idAgente = ".$final['agente']." or produto.idAgente = ".$final['agente'].")";
                $join = true;
            }
            if($final['subagente']){
                if($where){
                    $where = $where.' and ';
                }
                $where = $where."produto.idSubAgente = ".$final['subagente'];
                $join = true;
            }
            if($final['universidade']){
                if($where){
                    $where = $where.' and ';
                }
                $where = $where."cliente.idUniversidade = ".$final['universidade'];
            }
            if($final['curso']){
                if($where){
                    $where = $where.' and ';
                }
                $where = $where."produto.tipo like '".$final['curso']."'";
                $join = true;
            }
            if($final['institutoOrigem']){
                if($where){
                    $where = $where.' and ';
                }
                $where = $where."cliente.nomeInstituicaoOrigem like '".$final['intitutoOrigem']."'";
            }
            if($final['atividade']){
                if($where){
                    $where = $where.' and ';
                }
                $where = $where."cliente.estado like '".$final['atividade']."'";
            }
            if($where){
                if($join){
                    $Clientes = Cliente::leftJoin('produto','cliente.idCliente','=','produto.idCliente')->whereRaw($where)->groupBy('cliente.idCliente')->get();
                }else{
                    $Clientes = Cliente::whereRaw($where)->groupBy('cliente.idCliente')->get();
                }
            }else{
                $Clientes = Cliente::all();
            }
            return ['results' => $Clientes];
        /*}else{
            abort(401);
        }/**/
    }
}
