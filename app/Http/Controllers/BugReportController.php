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
        if (Auth()->user()->tipo == "admin" && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){
            $bugreports = RelatorioProblema::orderByRaw("FIELD(estado, \"Pendente\", \"Em curso\", \"Resolvido\")")->orderBy("created_at", "DESC")->get();
            return view('bugreport.list', compact('bugreports'));
        }else{
            abort(401);
        }
    }

    public function show(RelatorioProblema $bugreport)
    {
        if (Auth()->user()->tipo == "admin" && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){
            return view('bugreport.show', compact('bugreport'));
        }else{
            abort(401);
        }
    }

    public function update(RelatorioProblema $bugreport, Request $request)
    {
        if (Auth()->user()->tipo == "admin" && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){
            $status = $request->input('estado');
            $bugreport->estado = $status;
            $bugreport->save();
            return redirect()->route('bugreport.index')->with("success", "Relatório atualizado com sucesso!");
        }else{
            abort(401);
        }
    }

    public function destroy(RelatorioProblema $bugreport)
    {
        if (Auth()->user()->tipo == "admin" && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){
            $bugreport->delete();
            return redirect()->route('bugreport.index')->with('success', 'Relatório eliminado com sucesso!');
        }else{
            abort(401);
        }
    }

    public function download(RelatorioProblema $bugreport)
    {
        if (Auth()->user()->tipo == "admin" && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){
            return Storage::disk('public')->download('report-errors/'.$bugreport->screenshot);
        }else{
            abort(401);
        }
    }
}
