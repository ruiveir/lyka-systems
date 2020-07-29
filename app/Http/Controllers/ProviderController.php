<?php

namespace App\Http\Controllers;

use App\Fornecedor;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProviderRequest;
use App\Http\Requests\UpdateProviderRequest;

class ProviderController extends Controller
{
    public function index()
    {
      if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){
        $providers = Fornecedor::all();
        return view('providers.list', compact('providers'));
      }else{
          /* não tem permissões */
          abort (401);
      }
    }

    public function create()
    {
      if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){
        $provider = new Fornecedor;
        return view('providers.add', compact('provider'));
      }else{
          /* não tem permissões */
          abort (401);
      }
    }

    public function store(StoreProviderRequest $providerRequest)
    {
      if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){
        $fields = $providerRequest->validated();
        $provider = new Fornecedor;
        $provider->fill($fields);
        $provider->save();
        return redirect()->route('provider.index')->with('success', 'Novo fornecedor criado com sucesso.');
      }else{
          /* não tem permissões */
          abort (401);
      }
    }

    public function show(Fornecedor $provider)
    {
      if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){
        return view('providers.show', compact('provider'));
      }else{
          /* não tem permissões */
          abort (401);
      }
    }

    public function edit(Fornecedor $provider)
    {
      if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){
        return view('providers.edit', compact('provider'));
      }else{
          /* não tem permissões */
          abort (401);
      }
    }

    public function update(UpdateProviderRequest $providerRequest, Fornecedor $provider)
    {
      if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){
        $fields = $providerRequest->validated();
        $provider->fill($fields);
        $provider->save();
        return redirect()->route('provider.index')->with('success', 'Fornecedor editado com sucesso.');
      }else{
          /* não tem permissões */
          abort (401);
      }
    }

    public function destroy(Fornecedor $provider)
    {
      if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){
        $provider->delete();
        return redirect()->route('provider.index')->with('success', 'Fornecedor eliminado com sucesso');
      }else{
          /* não tem permissões */
          abort (401);
      }
    }
}
