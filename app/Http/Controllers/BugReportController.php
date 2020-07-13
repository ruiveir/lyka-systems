<?php

namespace App\Http\Controllers;

use App\RelatorioProblema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BugReportController extends Controller
{
    public function index()
    {
        $bugreports = RelatorioProblema::orderByRaw("FIELD(estado, \"Pendente\", \"Em curso\", \"Resolvido\")")->orderBy("created_at", "DESC")->get();
        return view('bugreport.list', compact('bugreports'));
    }

    public function show(RelatorioProblema $bugreport)
    {
        return view('bugreport.show', compact('bugreport'));
    }

    public function update(RelatorioProblema $bugreport, Request $request)
    {
        $status = $request->input('estado');
        $bugreport->estado = $status;
        $bugreport->save();
        return redirect()->route('bugreport.index')->with("success", "Relatório atualizado com sucesso!");
    }

    public function destroy(RelatorioProblema $bugreport)
    {
        $bugreport->delete();
        return redirect()->route('bugreport.index')->with('success', 'Relatório eliminado com sucesso!');
    }

    public function download(RelatorioProblema $bugreport)
    {
        return Storage::disk('public')->download('report-errors/'.$bugreport->screenshot);
    }
}
