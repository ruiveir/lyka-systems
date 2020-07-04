<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\FaseStock;
use App\ProdutoStock;
use App\DocStock;
use App\Http\Requests\StoreFasestockRequest;
use Illuminate\Support\Facades\Auth;

class FasestockController extends Controller
{
    public function index()
    {
        return redirect()->route('dashboard');
    }

    public function create(){
        return redirect()->route('dashboard');
    }

    public function store(StoreFasestockRequest $requestFase, ProdutoStock $produtostock){
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){
            $faseFields = $requestFase->validated();

            $faseStock = new FaseStock();
            $faseStock->fill($faseFields);
            $idProdutoStock = $produtostock->idProdutoStock;

            $faseStock->idProdutoStock = $idProdutoStock;

            $faseStock->save();

            return redirect()->back()->with('success', 'Fase stock adicionada com sucesso');
        }else{
            /* não tem permissões */
            abort (401);
        }
    }

    public function show(DocStock $docstocks, FaseStock $fasestock){
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){
            $nrDocs = 1;
            $docstocks = DocStock::where('idFaseStock', '=', $fasestock->idFaseStock)->get();
            return view('fasestock.show', compact('fasestock', 'docstocks', 'nrDocs'));
        }else{
            /* não tem permissões */
            abort (401);
        }
    }

    public function edit(FaseStock $fasestock)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){
            return view('fasestock.edit', compact('fasestock'));
        }else{
            /* não tem permissões */
            abort (401);
        }
    }

    public function update(StoreFasestockRequest $request, FaseStock $fasestock)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){
            $fields = $request->validated();
            $fasestock->fill($fields);

            // data em que foi modificado
            $t=time();
            $fasestock->updated_at == date("Y-m-d",$t);
            $fasestock->save();

            return redirect()->back()->with('success', 'Dados da fase de stock modificados com sucesso');
        }else{
            /* não tem permissões */
            abort (401);
        }
    }

    public function destroy(FaseStock $fasestock){
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){
            $fasestock->delete();

            return redirect()->back()->with('success', 'Fase stock eliminada com sucesso');
        }else{
            /* não tem permissões */
            abort (401);
        }
    }
}
