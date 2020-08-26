<?php
namespace App\Http\Controllers;

use App\DocStock;
use App\FaseStock;
use App\ProdutoStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProdutosstockRequest;

class ProdutosstockController extends Controller
{
    public function __construct()
    {
        $this->middleware('superadmin');
    }

    public function index()
    {
        $produtoStocks = ProdutoStock::all();
        $totalfasestock = FaseStock::all()->count();
        $totaldocstock = DocStock::all()->count();
        $totalprodutostock = $produtoStocks->count();
        return view('produtostock.list', compact('produtoStocks', 'totalprodutostock', 'totalfasestock', 'totaldocstock'));
    }

    public function create()
    {
        $produtostock = new ProdutoStock();
        return view('produtostock.add', compact('produtostock'));
    }

    public function store(StoreProdutosstockRequest $requestProduto)
    {
        $produtoFields = $requestProduto->validated();
        $produtoStock = new ProdutoStock();
        $produtoStock->fill($produtoFields);
        $produtoStock->save();
        return redirect()->route('produtostock.index')->with('success', 'Produto stock adicionado com sucesso');
    }

    public function edit(ProdutoStock $produtostock)
    {
        return view('produtostock.edit', compact('produtostock'));
    }

    public function update(StoreProdutosstockRequest $request, ProdutoStock $produtostock)
    {
        $fields = $request->validated();
        $produtostock->fill($fields);
        $produtostock->save();
        return redirect()->route('produtostock.index')->with('success', 'Dados do produto de stock modificados com sucesso');
    }

    public function show(FaseStock $faseStocks,ProdutoStock $produtostock)
    {
        $nrfases = 1;
        $faseStocks = FaseStock::where('idProdutoStock', '=', $produtostock->idProdutoStock)->get();
        return view('produtostock.show', compact('produtostock', 'faseStocks', 'nrfases'));
    }

    public function destroy(ProdutoStock $produtostock)
    {
        $produtostock->delete();
        return redirect()->route('produtostock.index')->with('success', 'Produto stock eliminado com sucesso');
    }
}
