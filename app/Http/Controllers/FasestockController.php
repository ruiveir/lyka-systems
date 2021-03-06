<?php
namespace App\Http\Controllers;

use App\DocStock;
use App\FaseStock;
use App\ProdutoStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreFasestockRequest;

class FasestockController extends Controller
{
    public function __construct()
    {
        $this->middleware('superadmin');
    }

    public function store(StoreFasestockRequest $requestFase, ProdutoStock $produtostock)
    {
        $faseFields = $requestFase->validated();
        $faseStock = new FaseStock();
        $faseStock->fill($faseFields);
        $idProdutoStock = $produtostock->idProdutoStock;
        $faseStock->idProdutoStock = $idProdutoStock;
        $faseStock->save();
        return redirect()->back()->with('success', 'Fase stock adicionada com sucesso');
    }

    public function show(DocStock $docstocks, FaseStock $fasestock)
    {
        $nrDocs = 1;
        $docstocks = DocStock::where('idFaseStock', '=', $fasestock->idFaseStock)->get();
        return view('fasestock.show', compact('fasestock', 'docstocks', 'nrDocs'));
    }

    public function update(StoreFasestockRequest $request, FaseStock $fasestock)
    {
        $fields = $request->validated();
        $fasestock->fill($fields);
        $fasestock->save();
        return redirect()->route('produtostock.show',$fasestock->produtoStock)->with('success', 'Dados da fase de stock modificados com sucesso');
    }

    public function destroy(FaseStock $fasestock)
    {
        $documentsStock = $fasestock->docStock;
        if($documentsStock){
            foreach($documentsStock as $docstock){
                $docstock->delete();
            }
        }
        $fasestock->delete();
        return redirect()->back()->with('success', 'Fase stock eliminada com sucesso');
    }
}
