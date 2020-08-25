<?php

namespace App\Http\Controllers;

use App\RelatorioProblema;
use App\Notificacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BugReportController extends Controller
{
    public function index()
    {
        if (Auth()->user()->tipo == "admin" && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){
            $bugreports = RelatorioProblema::orderByRaw("FIELD(estado, \"Pendente\", \"Em curso\", \"Resolvido\")")->orderBy("created_at", "DESC")->get();
            return view('bugreport.list', compact('bugreports'));
        }else{
            abort(403);
        }
    }

    public function show(RelatorioProblema $bugreport)
    {
        if (Auth()->user()->tipo == "admin" && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){
            return view('bugreport.show', compact('bugreport'));
        }else{
            abort(403);
        }
    }

    public function update(RelatorioProblema $bugreport, Request $request)
    {
        if (Auth()->user()->tipo == "admin" && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){
            $status = $request->input('estado');
            $bugreport->estado = $status;
            $bugreport->save();
            return redirect()->route('bugreport.index')->with("success", "Relatório atualizado com sucesso!");
        }else{
            abort(403);
        }
    }

    public function destroy(RelatorioProblema $bugreport)
    {
        if (Auth()->user()->tipo == "admin" && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){
            $bugreport->delete();
            return redirect()->route('bugreport.index')->with('success', 'Relatório eliminado com sucesso!');
        }else{
            abort(403);
        }
    }

    public function download(RelatorioProblema $bugreport)
    {
        if (Auth()->user()->tipo == "admin" && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){
            return Storage::disk('public')->download('report-errors/'.$bugreport->screenshot);
        }else{
            abort(403);
        }
    }
}
