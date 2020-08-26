<?php
namespace App\Http\Controllers;

use App\DocStock;
use App\FaseStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreDocstockRequest;

class DocumentostockController extends Controller
{
    public function __construct()
    {
        $this->middleware('superadmin');
    }

    public function index()
    {
        return redirect()->route('dashboard');
    }

    public function create()
    {
        return redirect()->route('dashboard');
    }

    public function store(StoreDocstockRequest $requestDoc, FaseStock $fasestock)
    {
        $docFields = $requestDoc->validated();
        $docStock = new DocStock();
        $docStock->fill($docFields);
        $idFaseStock = $fasestock->idFaseStock;
        $docStock->idFaseStock = $idFaseStock;
        $docStock->save();
        return redirect()->back()->with('success', 'Documento stock adicionado com sucesso');
    }

    public function show(DocStock $documentostock){
        // $documentostock = DocStock::where('idFaseStock', '=', $fasestock->idFaseStock)->get();
        return view('documentostock.show', compact('documentostock'));
    }

    public function edit(DocStock $documentostock)
    {
        return view('documentostock.edit', compact('documentostock'));
    }

    public function update(StoreDocstockRequest $request, DocStock $documentostock)
    {
        $fields = $request->validated();
        $documentostock->fill($fields);
        $documentostock->save();
        return redirect()->route('fasestock.show',$documentostock->faseStock)->with('success', 'Dados do documento de stock modificados com sucesso');
    }

    public function destroy(DocStock $documentostock)
    {
        $documentostock->delete();
        return redirect()->back()->with('success', 'Documento stock eliminado com sucesso');
    }
}
