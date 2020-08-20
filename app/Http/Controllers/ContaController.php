<?php
namespace App\Http\Controllers;

use App\Conta;
use Illuminate\Http\Request;
use App\Http\Requests\StoreContaRequest;
use App\Http\Requests\UpdateContaRequest;

class ContaController extends Controller
{
    public function index()
    {
      if (Auth()->user()->tipo == "admin" && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){
        $contas = Conta::all();
        return view('conta.list', compact('contas'));
      }else{
          abort(403);
      }
    }

    public function create()
    {
      if (Auth()->user()->tipo == "admin" && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){
        $conta = new Conta;
        return view('conta.add', compact('conta'));
      }else{
          abort(403);
      }
    }

    public function store(StoreContaRequest $contaRequest)
    {
      if (Auth()->user()->tipo == "admin" && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){
      $fields = $contaRequest->validated();
        $conta = new Conta;
        $conta->fill($fields);
        $contas = Conta::withTrashed()->get();
        foreach ($contas as $trash){
            if($trash->numConta == $conta->numConta || $trash->IBAN == $conta->IBAN || $trash->SWIFT == $conta->SWIFT){
                return redirect()->back()->withInput();
            }
        }
        $conta->save();
        return redirect()->route('conta.index')->with('success', 'Conta bancária adicionada com sucesso.');
      }else{
          abort(403);
      }
    }

    public function show(Conta $conta)
    {
      if (Auth()->user()->tipo == "admin" && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){
        return view('conta.show', compact('conta'));
      }else{
          abort(403);
      }
    }

    public function edit(Conta $conta)
    {
      if (Auth()->user()->tipo == "admin" && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){
        return view('conta.edit', compact('conta'));
      }else{
          abort(403);
      }
    }

    public function update(UpdateContaRequest $contaRequest, Conta $conta)
    {
      if (Auth()->user()->tipo == "admin" && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){
        $fields = $contaRequest->validated();
        $conta->fill($fields);

        $contas = Conta::withTrashed()->get();
        foreach ($contas as $trash){
            if($trash->numConta == $conta->numConta || $trash->IBAN == $conta->IBAN || $trash->SWIFT == $conta->SWIFT){
                return redirect()->back()->withInput();
            }
        }
        $conta->updated_at = time();
        $conta->save();
        return redirect()->route('conta.index')->with('success', 'Conta bancária editada com sucesso.');
      }else{
          abort(403);
      }
    }

    public function destroy(Conta $conta)
    {
      if (Auth()->user()->tipo == "admin" && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){
        $conta->delete();
        return redirect()->route('conta.index')->with('success', 'Conta bancária eliminada com sucesso.');
      }else{
          abort(403);
      }
    }
}
