<?php

namespace App\Http\Controllers;

use App\Biblioteca;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreLibraryRequest;
use App\Http\Requests\UpdateLibraryRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->email != "admin@test.com")||
            (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)){
            /* Ficheiros para os agentes */
            if (Auth::user()->tipo != "admin" ){
                $files = Biblioteca::
                where('acesso', '=', "Público")
                ->get();
            }else{
                /* Ficheiros para os admins */
                $files = Biblioteca::all();

            }


            /* Calcula o espaço oucupado por todos os ficheiros na pasta da biblioteca */
            function folderSize ($dir)
            {
                $size = 0;

                foreach (glob(rtrim($dir, '/').'/*', GLOB_NOSORT) as $each) {
                    $size += is_file($each) ? filesize($each) : folderSize($each);
                }

                return $size;
            }
            function formatSize($bytes){
                $kb = 1024;
                $mb = $kb * 1024;
                $gb = $mb * 1024;
                $tb = $gb * 1024;
                if (($bytes >= 0) && ($bytes < $kb)) {
                return $bytes . ' B';
                } elseif (($bytes >= $kb) && ($bytes < $mb)) {
                return ceil($bytes / $kb) . ' KB';
                } elseif (($bytes >= $mb) && ($bytes < $gb)) {
                return ceil($bytes / $mb) . ' MB';
                } elseif (($bytes >= $gb) && ($bytes < $tb)) {
                return ceil($bytes / $gb) . ' GB';
                } elseif ($bytes >= $tb) {
                return ceil($bytes / $tb) . ' TB';
                } else {
                return $bytes . ' B';
                }
                }


            $size = formatSize (folderSize(storage_path('app/public/library')));

            return view('libraries.list', compact('files','size'));
        }else{
            /* não tem permissões */
            abort (401);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->email != "admin@test.com"){
            $library = new Biblioteca;
            return view('libraries.add' , compact('library'));
        }else{
            /* não tem permissões */
            abort (401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLibraryRequest $request)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->email != "admin@test.com"){
            $file = new Biblioteca;
            $fields = $request->validated();
            $file->fill($fields);

            $file->save();

            if ($request->hasFile('ficheiro')) {
                $uploadfile = $request->file('ficheiro');

                $file_name = $request->file_name . '('. $file->idBiblioteca.').'.$uploadfile->getClientOriginalExtension();
                $file->ficheiro = $file_name;
                Storage::disk('public')->putFileAs('library/', $uploadfile, $file_name);

                $file->save();
            }

            return redirect()->route('libraries.index')->with('success', 'Ficheiro carregado com sucesso!');
        }else{
            /* não tem permissões */
            abort (401);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Biblioteca  $file
     * @return \Illuminate\Http\Response
     */
    public function show(Biblioteca $library)
    {
        return redirect()->route('dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Biblioteca  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(Biblioteca $library)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->email != "admin@test.com"){
            /* Permissões */
            if (Auth::user()->tipo != "admin" ){
                abort (401);
            }

            return view('libraries.edit', compact('library'));
        }else{
            /* não tem permissões */
            abort (401);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Biblioteca  $library
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLibraryRequest $request, Biblioteca $library)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->email != "admin@test.com"){
            $fields = $request->validated();
            $library->fill($fields);

            if ($request->hasFile('ficheiro')) {


            /* Verifica se o ficheiro antigo existe e apaga do storage*/
            $oldfile=Biblioteca::
            where('idBiblioteca', '=',$library->idBiblioteca)
            ->first();

            if(Storage::disk('public')->exists('library/' . $oldfile->ficheiro)){
                Storage::disk('public')->delete('library/' . $oldfile->ficheiro);
            }

                /* Guarda o novo ficheiro */
                $uploadfile = $request->file('ficheiro');
                $file_name = $request->file_name . '('. $library->idBiblioteca.').'.$uploadfile->getClientOriginalExtension();
                $library->ficheiro = $file_name;
                Storage::disk('public')->putFileAs('library/', $uploadfile, $file_name);

                $library->save();
            }

            // data em que foi modificado
            $t=time();
            $library->updated_at == date("Y-m-d",$t);

            $library->save();

            return redirect()->route('libraries.index')->with('success', 'Informações do ficheiro editadas com sucesso!');
        }else{
            /* não tem permissões */
            abort (401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Biblioteca  $library
     * @return \Illuminate\Http\Response
     */
    public function destroy(Biblioteca $library)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){



            /* Verifica se o ficheiro antigo existe e apaga do storage*/
            $oldfile=Biblioteca::
            where('idBiblioteca', '=',$library->idBiblioteca)
            ->first();

            if(Storage::disk('public')->exists('library/' . $oldfile->ficheiro)){
                Storage::disk('public')->delete('library/' . $oldfile->ficheiro);
            }

            $library->delete();

            return redirect()->route('libraries.index')->with('success', 'Ficheiro eliminado com sucesso!');
        }else{
            /* não tem permissões */
            abort (401);
        }

    }


}
