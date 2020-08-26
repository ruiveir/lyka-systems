<?php
namespace App\Http\Controllers;

use App\Conta;
use Illuminate\Http\Request;
use App\Http\Requests\StoreContaRequest;
use App\Http\Requests\UpdateContaRequest;

class ContaController extends Controller
{
    public function __construct()
    {
        $this->middleware('superadmin');
    }

    public function index()
    {
        $contas = Conta::all();
        return view('conta.list', compact('contas'));
    }

    public function create()
    {
        $conta = new Conta;
        return view('conta.add', compact('conta'));
    }

    public function store(StoreContaRequest $contaRequest)
    {
          $fields = $contaRequest->validated();
          $conta = new Conta;
          $conta->fill($fields);
          $conta->save();
          return redirect()->route('conta.index')->with('success', 'Conta bancária adicionada com sucesso.');
    }

    public function show(Conta $conta)
    {
        return view('conta.show', compact('conta'));
    }

    public function edit(Conta $conta)
    {
        return view('conta.edit', compact('conta'));
    }

    public function update(UpdateContaRequest $contaRequest, Conta $conta)
    {
        $fields = $contaRequest->validated();
        $conta->fill($fields);
        $conta->save();
        return redirect()->route('conta.index')->with('success', 'Conta bancária editada com sucesso.');
    }

    public function destroy(Conta $conta)
    {
        $conta->delete();
        return redirect()->route('conta.index')->with('success', 'Conta bancária eliminada com sucesso.');
    }
}
