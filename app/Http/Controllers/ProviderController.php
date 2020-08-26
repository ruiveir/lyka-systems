<?php

namespace App\Http\Controllers;

use App\Fornecedor;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProviderRequest;
use App\Http\Requests\UpdateProviderRequest;

class ProviderController extends Controller
{
    public function __construct()
    {
        $this->middleware('superadmin');
    }

    public function index()
    {
        $providers = Fornecedor::all();
        return view('providers.list', compact('providers'));
    }

    public function create()
    {
        $provider = new Fornecedor;
        return view('providers.add', compact('provider'));
    }

    public function store(StoreProviderRequest $providerRequest)
    {
        $fields = $providerRequest->validated();
        $provider = new Fornecedor;
        $provider->fill($fields);
        $provider->save();
        return redirect()->route('provider.index')->with('success', 'Novo fornecedor criado com sucesso.');
    }

    public function show(Fornecedor $provider)
    {
        return view('providers.show', compact('provider'));
    }

    public function edit(Fornecedor $provider)
    {
        return view('providers.edit', compact('provider'));
    }

    public function update(UpdateProviderRequest $providerRequest, Fornecedor $provider)
    {
        $fields = $providerRequest->validated();
        $provider->fill($fields);
        $provider->save();
        return redirect()->route('provider.index')->with('success', 'Fornecedor editado com sucesso.');
    }

    public function destroy(Fornecedor $provider)
    {
        $provider->delete();
        return redirect()->route('provider.index')->with('success', 'Fornecedor eliminado com sucesso');
    }
}
