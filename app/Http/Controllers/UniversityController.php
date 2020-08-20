<?php

namespace App\Http\Controllers;

use App\User;
use App\Agenda;
use App\Cliente;
use App\Contacto;
use App\Produto;
use App\Universidade;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\StoreUniversidadeRequest;
use App\Http\Requests\UpdateUniversidadeRequest;

class UniversityController extends Controller
{
    public function index()
    {
        /* Permissões */
        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->email != "admin@test.com")||
        (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)){

            $universities = Universidade::all();

            if( $universities->isEmpty()){
                $universities=null;
            }


            return view('universities.list', compact('universities'));
        }else{
            abort(401);
        }


    }

    public function create()
    {
        /* Permissões */
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->email != "admin@test.com"){

            $university = new Universidade;

            return view('universities.add', compact('university'));
        }else{
            abort(401);
        }
    }

    public function store(StoreUniversidadeRequest $request)
    {
        /* Permissões */
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->email != "admin@test.com"){
            $fields = $request->validated();

            $university = new Universidade;
            $university->fill($fields);

            $unis = Universidade::withTrashed()->get();
            foreach ($unis as $trash){
                if($trash->NIF == $university->NIF){
                    return redirect()->back()->withInput();
                }
            }
            // Data em que o registo é criado
            $t = time();
            $university->create_at == date("Y-m-d", $t);
            $university->save();
            return redirect()->route('universities.show',$university)->with('success', 'Universidade Adicionada com Sucesso!');
        }else{
            abort(401);
        }

    }

    public function show(Universidade $university)
    {
        /* Permissões */
        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->email != "admin@test.com")||
        (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)){

            /* Obtem os eventos da universidade */
            $eventos = Agenda::
            where('idUniversidade', $university->idUniversidade)
            ->orderBy('dataInicio', 'asc')
            ->get();

            if ($eventos->isEmpty()) {
                $eventos=null;
            }


            /* Obtem os clientes da que estão na universidade */
    /*      SELECT DISTINCT cliente.idCliente FROM cliente JOIN produto ON
            cliente.idCliente=produto.idCliente WHERE produto.idUniversidade1 LIKE 1 OR produto.idUniversidade2 =1; */

            $clients = Cliente::distinct('Cliente.idCliente')
            ->join('Produto', 'Produto.idCliente', '=', 'Cliente.idCliente')
            ->where('Produto.idUniversidade1', '=',$university->idUniversidade )
            ->orWhere('Produto.idUniversidade2', '=',$university->idUniversidade)
            ->select('Cliente.*')
            ->get();

        /*  dd($clients); */

            if ($clients->isEmpty()) {
                $clients=null;
            }



            /* Contactos da universidade */
            $contacts = Contacto::
            where('idUniversidade', '=', $university->idUniversidade)
            ->get();
            if ($contacts->isEmpty()) {
                $contacts=null;
            }

            return view('universities.show', compact('university','eventos','clients','contacts'));
        }else{
            abort(401);
        }
    }




    public function edit(Universidade $university)
    {
        /* Permissões */
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->email != "admin@test.com"){

            return view('universities.edit', compact('university'));
        }else{
            abort(401);
        }
    }



    public function update(UpdateUniversidadeRequest $request, Universidade $university)
    {
        /* Permissões */
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->email != "admin@test.com"){
            $fields = $request->validated();
            $university->fill($fields);

            $unis = Universidade::withTrashed()->get();
            foreach ($unis as $trash){
                if($trash->NIF == $university->NIF){
                    return redirect()->back()->withInput();
                }
            }
            // Data em que o registo é modificado
            $t = time();
            $university->updated_at == date("Y-m-d", $t);

            /* Update das slugs */
            $university->slug =post_slug($university->nome);

            $university->save();

            return redirect()->route('universities.show',$university)->with('success', 'Universidade Editada com Sucesso!');
        }else{
            abort(401);
        }

    }

    public function destroy(Universidade $university)
    {
        /* Permissões */
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){
            $university->delete();
            return redirect()->route('universities.index')->with('success', 'Universidade Eliminada com Sucesso!');
        }else{
            abort(401);
        }
    }
}
