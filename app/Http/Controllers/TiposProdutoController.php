<?php

namespace App\Http\Controllers;

use App\TipoProduto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\StoreTipoProdutoRequest;
/* use App\Http\Requests\UpdateTipoProdutoRequest; */

class TiposProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiposProduto = TipoProduto::All();

        return view('tiposProdutos.list',compact('tiposProduto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoProduto = new TipoProduto;
        return view('tiposProdutos.add',compact('tipoProduto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTipoProdutoRequest $request)
    {
        /* obtem os dados para criar o tipo de produto */
        $tipoProduto = new TipoProduto;
        $fields = $request->validated();

        $tipoProduto->fill($fields);

        $tipoProduto->designacao;

        $tipoProduto->save();

        return redirect()->route('tiposprodutos.index')->with('success', 'Tipo de produto criado com sucesso!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipoProduto  $tipoProduto
     * @return \Illuminate\Http\Response
     */
    public function show(TipoProduto $tipoProduto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoProduto  $tipoProduto
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoProduto $tipoProduto)
    {
        return view('tiposProdutos.edit',compact('tipoProduto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoProduto  $tipoProduto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoProduto $tipoProduto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoProduto  $tipoProduto
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoProduto $tipoProduto)
    {

        dd($tipoProduto);
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){
            /* "Apaga" o registo */
            $tipoProduto->delete();
            return redirect()->route('tiposprodutos.index')->with('success', 'Tipo de produto eliminado com sucesso!');
        }else{
            abort(403);
        }
    }
}
