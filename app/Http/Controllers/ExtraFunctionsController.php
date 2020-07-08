<?php

namespace App\Http\Controllers;

use Mail;
use App\Agente;
use App\Cliente;
use App\Fornecedor;
use App\Universidade;
use App\RelatorioProblema;
use Illuminate\Http\Request;
use App\Mail\ReportProblemMail;
use Illuminate\Support\Facades\Storage;

class ExtraFunctionsController extends Controller
{
    /* Reportar Problema -> Vista Principal */
    public function report()
    {
        if (Auth()->user()->tipo == 'admin') {
            $user = Auth()->user()->admin;
        } elseif (Auth()->user()->tipo == 'agente') {
            $user = Auth()->user()->agente;
        } else {
            $user = Auth()->user()->cliente;
        }
        return view('report', compact('user'));
    }

    /* Reportar Problema -> Envio de Mail + Store na base de dados */
    public function reportmail(Request $request)
    {
        $fields = $request->validate(
        [
            'nome' => 'required',
            'email' => 'required',
            'telemovel' => 'nullable',
            'screenshot' => 'nullable',
            'relatorio' => 'required'
        ]);

        $report = new RelatorioProblema;
        $report->fill($fields);
        $report->save();

        if ($request->hasFile('screenshot')) {
            $errorfile = $request->file('screenshot');
            $errorimg = 'error_'.strtolower($report->idRelatorioProblema).'.'.$errorfile->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('report-errors/', $errorfile, $errorimg);
            $report->screenshot = $errorimg;
            $report->save();
        }

        $name = $report->nome;
        $email = $report->email;
        $phone = $report->telemovel;
        $text = $report->relatorio;

        if (isset($errorfile)) {
            Mail::to('lykasystems@mail.com')->send(new ReportProblemMail($name, $email, $phone, $text, $errorfile));
        }else {
            $errorfile = null;
            Mail::to('lykasystems@mail.com')->send(new ReportProblemMail($name, $email, $phone, $text, $errorfile));
        }

        return redirect()->route('report')->with('success', 'Relatório enviado com sucesso. Obrigado pela sua contribuição!');
    }

    /* Procura de contactos */
    public function searchcontact(Request $request)
    {
        $user = $request->input('user');
        $name = $request->input('name');
        $surname = $request->input('surname');

        switch ($user) {
          case 'clientes':
              if (($name && $surname) != null) {
                  $result = Cliente::where('nome', 'like', '%'.$name.'%')->where('apelido', 'like', '%'.$surname.'%')->select('nome', 'apelido', 'telefone1', 'email', 'fotografia', 'slug')->get();
              }elseif ($name != null && $surname == null) {
                  $result = Cliente::where('nome', 'like', '%'.$name.'%')->select('nome', 'apelido', 'telefone1', 'email', 'fotografia', 'slug')->get();
              }elseif ($name == null && $surname != null) {
                  $result = Cliente::where('apelido', 'like', '%'.$surname.'%')->select('nome', 'apelido', 'telefone1', 'email', 'fotografia', 'slug')->get();
              }else {
                  return response()->json("nok", 500);
              }
            break;

          case 'agentes':
              if (($name && $surname) != null) {
                  $result = Agente::where('nome', 'like', '%'.$name.'%')->where('apelido', 'like', '%'.$surname.'%')->select('nome', 'apelido', 'telefone1', 'email', 'fotografia', 'slug')->get();
              }elseif ($name != null && $surname == null) {
                  $result = Agente::where('nome', 'like', '%'.$name.'%')->select('nome', 'apelido', 'telefone1', 'email', 'fotografia', 'slug')->get();
              }elseif ($name == null && $surname != null) {
                  $result = Agente::where('apelido', 'like', '%'.$surname.'%')->select('nome', 'apelido', 'telefone1', 'email', 'fotografia', 'slug')->get();
              }else {
                  return response()->json("nok", 500);
              }
            break;

          case 'universidades':
              if ($name != null) {
                  $result = Universidade::where('nome', 'like', '%'.$name.'%')->select('nome', 'telefone', 'email', 'slug')->get();
              }else {
                  return response()->json("nok", 500);
              }
            break;

          case 'fornecedores':
              if ($name != null) {
                  $result = Fornecedor::where('nome', 'like', '%'.$name.'%')->select('nome', 'morada', 'contacto', 'slug')->get();
              }else {
                  return response()->json("nok", 500);
              }
            break;
        }

        if (count($result)) {
            return response()->json($result, 200);
        }else {
            return response()->json("nok", 404);
        }
    }
}
