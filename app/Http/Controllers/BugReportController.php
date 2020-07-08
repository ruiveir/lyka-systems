<?php

namespace App\Http\Controllers;

use App\RelatorioProblema;
use Illuminate\Http\Request;

class BugReportController extends Controller
{
    public function index()
    {
        $bugreports = RelatorioProblema::orderByRaw("FIELD(estado, \"Pendente\", \"Em curso\", \"Resolvido\")")->get();
        return view('bugreport.list', compact('bugreports'));
    }

    public function show(RelatorioProblema $bugreport)
    {
        dd("por favor que não seja este");
    }

    public function update(RelatorioProblema $bugreport, Request $request)
    {
        dd("hello world");
        $status = $request->input('estado');
    }

    public function destroy(RelatorioProblema $bugreport)
    {
        $bugreport->delete();
        return redirect()->route('bugreport.index')->with('success', 'Relatório eliminado com sucesso!');
    }
}
