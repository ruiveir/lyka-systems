<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\ProdutoStock;
use App\FaseStock;
use App\DocStock;

use App\Cliente;
use App\Produto;
use App\Agente;
use App\Universidade;

class StockController extends Controller
{
    public function produtos(){
        $produtos = ProdutoStock::all();
        return ['results' => $produtos];
    }
    public function produto($id){
        $produto = ProdutoStock::where('idProdutoStock','=',$id)->get();
        $fases = FaseStock::where('idProdutoStock','=',$id)->get();
        return ['produto' => $produto, 'fases' => $fases];
    }
    public function fases($id){
        $fases = FaseStock::where('idProdutoStock','=',$id)->get();
        return ['results' => $fases];
    }
    public function documentos($id){
        $documentos = DocStock::where('idFaseStock','=',$id)->get();
        return ['results' => $documentos];
    }


}
