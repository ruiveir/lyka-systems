<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Cliente;

class ListagemController extends Controller
{

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
                $where = $where.'Cliente.paisNaturalidade like "'.$final['pais'].'"';
            }
            if($final['cidade']){
                if($where){
                    $where = $where.' and ';
                }
                $where = $where.'Cliente.cidade like "'.$final['cidade'].'"';
            }
            if($final['agente']){
                if($where){
                    $where = $where.' and ';
                }
                $where = $where.'Cliente.idAgente = '.$final['agente'].' or Produto.idAgente = '.$final['agente'];
                $join = true;
            }
            if($final['subagente']){
                if($where){
                    $where = $where.' and ';
                }
                $where = $where.'Produto.idSubAgente = '.$final['subagente'];
                $join = true;
            }
            if($final['universidade']){
                if($where){
                    $where = $where.' and ';
                }
                $where = $where.'Cliente.idUniversidade = '.$final['universidade'];
            }
            if($final['curso']){
                if($where){
                    $where = $where.' and ';
                }
                $where = $where.'Produto.tipo like "'.$final['curso'].'"';
                $join = true;
            }
            if($final['institutoOrigem']){
                if($where){
                    $where = $where.' and ';
                }
                $where = $where.'Cliente.nomeInstituicaoOrigem like "'.$final['intitutoOrigem'].'"';
            }
            if($final['atividade']){
                if($where){
                    $where = $where.' and ';
                }
                $where = $where.'Cliente.estado like "'.$final['atividade'].'"';
            }
            if($join){
                $Clientes = Cliente::leftJoin('Produto','Cliente.idCliente','=','Produto.idCliente')->whereRaw($where)->get();
            }else{
                $Clientes = Cliente::whereRaw($where)->get();
            }
            return ['results' => $Clientes];
        /*}else{
            abort(401);
        }/**/
    }
}
