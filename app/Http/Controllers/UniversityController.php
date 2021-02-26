<?php
namespace App\Http\Controllers;

use App\User;
use App\Agenda;
use App\Cliente;
use App\Produto;
use App\Contacto;
use App\Universidade;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUniversidadeRequest;
use App\Http\Requests\UpdateUniversidadeRequest;

class UniversityController extends Controller
{
    public function index()
    {
        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null) || (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)){
            $universities = Universidade::all();
            if($universities->isEmpty()){
                $universities = null;
            }
            return view('universities.list', compact('universities'));
        }else{
            abort(403);
        }
    }

    public function create()
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null){
            $university = new Universidade;
            return view('universities.add', compact('university'));
        }else{
            abort(403);
        }
    }

    public function store(StoreUniversidadeRequest $request)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null){
            $fields = $request->validated();
            $university = new Universidade;
            $university->fill($fields);
            $university->save();
            return redirect()->route('universities.show',$university)->with('success', 'Universidade Adicionada com Sucesso!');
        }else{
            abort(403);
        }

    }

    public function show(Universidade $university)
    {
        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null) || (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)){
            $eventos = Agenda::where('idUniversidade', $university->idUniversidade)
            ->orderBy('data_inicio', 'asc')
            ->get();

            if ($eventos->isEmpty()) {
                $eventos = null;
            }

            $clients = Cliente::distinct('cliente.idCliente')
            ->join('produto', 'produto.idCliente', 'cliente.idCliente')
            ->where('produto.idUniversidade1', $university->idUniversidade )
            ->orWhere('produto.idUniversidade2', $university->idUniversidade)
            ->select('cliente.*')
            ->get();

            if ($clients->isEmpty()) {
                $clients = null;
            }

            $contacts = Contacto::where('idUniversidade', $university->idUniversidade)->get();

            if ($contacts->isEmpty()) {
                $contacts = null;
            }

            return view('universities.show', compact('university','eventos','clients','contacts'));
        }else{
            abort(403);
        }
    }

    public function edit(Universidade $university)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null){
            return view('universities.edit', compact('university'));
        }else{
            abort(403);
        }
    }

    public function update(UpdateUniversidadeRequest $request, Universidade $university)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null){
            $fields = $request->validated();
            $university->fill($fields);
            $university->save();
            return redirect()->route('universities.show',$university)->with('success', 'Universidade Editada com Sucesso!');
        }else{
            abort(403);
        }
    }

    public function destroy(Universidade $university)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){
            $university->delete();
            return redirect()->route('universities.index')->with('success', 'Universidade Eliminada com Sucesso!');
        }else{
            abort(403);
        }
    }
}
