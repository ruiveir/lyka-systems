<?php

namespace App\Http\Controllers;

use App\Agenda;
use App\User;
use App\Universidade;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AgendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Permissões */
        if (Auth()->user()->tipo != 'admin' || Auth()->user()->idAdmin == null){
            abort (401);
        }

        //$agends = Agenda::all();
        $agends = Agenda::where('idUser', Auth::user()->idUser)->get();
        /*whereDate('dataInicio', '<=',Carbon::today())->
            whereDate('dataFim', '>=',Carbon::today())->*/
        $todayAgends = Agenda:: whereDate('dataInicio', '<=',Carbon::now())->
            whereDate('dataFim', '>=',Carbon::now())
            ->get();

        return view('agends.list', compact('agends', 'todayAgends'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('dashboard');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* Permissões */
        if (Auth()->user()->tipo != 'admin' || Auth()->user()->idAdmin == null){
            abort (401);
        }

        switch($request->input('action')) {
            case "save":

                $this->validate($request, [
                    'idUniversidade'=> 'nullable',
                    'titulo' => 'required',
                    'descricao' => 'required',
                    'dataInicio' => 'required',
                    'dataFim' => 'required',
                    'cor' => 'required',
                ]);

                $agenda = Agenda::find($request->input('idAgenda'));

                $successMessage = "";

                if ($agenda) {

                    $agenda->titulo = $request->input('titulo');
                    $agenda->descricao = $request->input('descricao');
                    $agenda->dataInicio = $request->input('dataInicio');
                    $agenda->dataFim = $request->input('dataFim');
                    $agenda->cor = $request->input('cor');

                    $successMessage = "Evento Editado com Sucesso!";

                } else {
                    $agenda = new Agenda;

                    $agenda->idUser = auth()->user()->idUser;
                    $agenda->idUniversidade = $request->idUniversidade;

                    $agenda->titulo = $request->input('titulo');
                    $agenda->descricao = $request->input('descricao');
                    $agenda->dataInicio = $request->input('dataInicio');
                    $agenda->dataFim = $request->input('dataFim');
                    $agenda->cor = $request->input('cor');

                    $successMessage = "Evento Adicionado com Sucesso!";
                }

                $agenda->save();

                return redirect()->back()->with('success', $successMessage);
                break;
            case "delete":
                $agenda = Agenda::find($request->input('idAgenda'));
                $agenda->delete();
                return redirect()->back()->with('success', 'Evento Eliminado!');
                break;
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function show(Agenda $agenda)
    {
        return redirect()->route('dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function edit(Agenda $agenda)
    {
        return redirect()->route('dashboard');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agenda $agenda)
    {
        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agenda $agenda)
    {
        /* Permissões */
        if (Auth()->user()->tipo != 'admin' || Auth()->user()->idAdmin == null){
            abort (401);
        }
        $agenda->delete();
        return redirect()->back()->with('success', 'Evento Eliminado!');
    }
}
