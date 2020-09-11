<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agente;
use App\Cliente;
use App\Universidade;
use App\Produto;

class ListagemController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
            $agentes = Agente::where('tipo', 'Agente')->get();
            $subagentes = Agente::where('tipo', 'Subagente')->get();
            $clientes = Cliente::all();
            $universidades = Universidade::all();
            $produtos = Produto::orderBy('tipo')->get();
            $clientesinstituto = Cliente::orderBy('nomeInstituicaoOrigem')->get();
            $clientespais = Cliente::orderBy('paisNaturalidade')->get();
            $cursos = null;
            $institutos = null;
            $paises= null;

            if($produtos){
                foreach($produtos as $produto){
                    $existe = false;
                    if($cursos){
                        foreach($cursos as $curso){
                            if($curso == $produto->tipo){
                                $existe = true;
                            }
                        }
                    }
                    if(!$existe){
                        $cursos[] = $produto->tipo;
                    }
                }
            }
            if($clientesinstituto){
                foreach($clientesinstituto as $cliente){
                    $existe = false;
                    if($institutos){
                        foreach($institutos as $instituto){
                            if($instituto == $cliente->nomeInstituicaoOrigem){
                                $existe = true;
                            }
                        }
                    }
                    if(!$existe){
                        $institutos[] = $cliente->nomeInstituicaoOrigem;
                    }
                }
            }
            if($clientespais){
                foreach($clientespais as $cliente){
                    $existe = false;
                    if($paises){
                        foreach($paises as $pais){
                            if($pais == $cliente->paisNaturalidade){
                                $existe = true;
                            }
                        }
                    }
                    if(!$existe){
                        $paises[] = $cliente->paisNaturalidade;
                    }
                }
            }

            return view('listagens.list', compact('agentes', 'subagentes', 'clientes', 'universidades', 'cursos','institutos','paises'));
    }

}
