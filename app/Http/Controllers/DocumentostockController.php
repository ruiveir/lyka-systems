<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\DocStock;
use App\FaseStock;
use App\Http\Requests\StoreDocstockRequest;
use Illuminate\Support\Facades\Auth;

class DocumentostockController extends Controller
{
    public function index()
    {
            return redirect()->route('dashboard');
    }
    public function create(){
            return redirect()->route('dashboard');
    }

    public function store(StoreDocstockRequest $requestDoc, FaseStock $fasestock){
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){
            $docFields = $requestDoc->validated();

            $docStock = new DocStock();
            $docStock->fill($docFields);
            $idFaseStock = $fasestock->idFaseStock;
            $docStock->idFaseStock = $idFaseStock;

            $docStock->save();

            return redirect()->back()->with('success', 'Documento stock adicionado com sucesso');
        }else{
            /* não tem permissões */
            abort (401);
        }
    }

    public function show(DocStock $documentostock){
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){
            // $documentostock = DocStock::where('idFaseStock', '=', $fasestock->idFaseStock)->get();

            return view('documentostock.show', compact('documentostock'));
        }else{
            /* não tem permissões */
            abort (401);
        }
    }

    public function edit(DocStock $documentostock)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){

            return view('documentostock.edit', compact('documentostock'));
        }else{
            /* não tem permissões */
            abort (401);
        }
    }

    public function update(StoreDocstockRequest $request, DocStock $documentostock)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){
            $fields = $request->validated();
            $documentostock->fill($fields);

            // data em que foi modificado
            $t=time();
            $documentostock->updated_at == date("Y-m-d",$t);
            $documentostock->save();

            return redirect()->back()->with('success', 'Dados do documento de stock modificados com sucesso');
        }else{
            /* não tem permissões */
            abort (401);
        }
    }

    public function destroy(DocStock $documentostock){
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){
            $documentostock->delete();

            return redirect()->back()->with('success', 'Documento stock eliminado com sucesso');
        }else{
            /* não tem permissões */
            abort (401);
        }
    }
}
