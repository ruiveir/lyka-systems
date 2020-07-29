<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Administrador;
use App\Agente;
use App\Cliente;
use App\Universidade;
use App\ProdutoStock;

class ListagemController extends Controller
{
    public function index()
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){
            $administradores = Administrador::all();
            $agentes = Agente::all();
            $clientes = Cliente::all();
            $universidades = Universidade::all();
            $produtoStocks = ProdutoStock::all();

            return view('listagens.list', compact('$administradores', 'agentes', 'clientes', '$universidades', 'produtoStocks'));
        }else{
            abort(401);
        }
    }

}
