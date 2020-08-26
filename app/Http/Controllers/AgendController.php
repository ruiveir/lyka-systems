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
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $agends = Agenda::where('idUser', Auth::user()->idUser)->get();

        $todayAgends = Agenda:: whereDate('dataInicio', '<=',Carbon::now())
        ->whereDate('dataFim', '>=',Carbon::now())
        ->get();

        return view('agends.list', compact('agends', 'todayAgends'));
    }

    public function create()
    {
        return redirect()->route('dashboard');
    }

    public function store(Request $request)
    {
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

    public function show(Agenda $agenda)
    {
        return redirect()->route('dashboard');
    }

    public function edit(Agenda $agenda)
    {
        return redirect()->route('dashboard');
    }

    public function update(Request $request, Agenda $agenda)
    {
        return redirect()->route('dashboard');
    }

    public function destroy(Agenda $agenda)
    {
        $agenda->delete();
        return redirect()->back()->with('success', 'Evento Eliminado!');
    }
}
