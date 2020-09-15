<?php

namespace App\Http\Controllers;

use App\Biblioteca;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreLibraryRequest;
use App\Http\Requests\UpdateLibraryRequest;

class LibraryController extends Controller
{
    public function index()
    {
        if ((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null) || (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)) {
            if (Auth::user()->tipo != "admin") {
                $files = Biblioteca::where('acesso', "Público")->get();
            } else {
                $files = Biblioteca::all();
            }

            function folderSize($dir)
            {
                $size = 0;
                foreach (glob(rtrim($dir, '/').'/*', GLOB_NOSORT) as $each) {
                    $size += is_file($each) ? filesize($each) : folderSize($each);
                }
                return $size;
            }

            function formatSize($bytes)
            {
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
            $size = formatSize(folderSize(storage_path('app/public/library')));
            return view('libraries.list', compact('files', 'size'));
        } else {
            abort(403);
        }
    }

    public function create()
    {
        if (Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null) {
            $library = new Biblioteca;
            return view('libraries.add', compact('library'));
        } else {
            abort(403);
        }
    }

    public function store(StoreLibraryRequest $request)
    {
        if (Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null) {
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
        } else {
            abort(403);
        }
    }

    public function show(Biblioteca $library)
    {
        return redirect()->route('dashboard');
    }

    public function edit(Biblioteca $library)
    {
        if (Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null) {
            return view('libraries.edit', compact('library'));
        } else {
            abort(403);
        }
    }

    public function update(UpdateLibraryRequest $request, Biblioteca $library)
    {
        if (Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null) {
            $oldfilename = $library->ficheiro;
            $fields = $request->validated();
            $library->fill($fields);
            $library->ficheiro = $oldfilename;

            if ($request->hasFile('ficheiro')) {
                $oldfile = Biblioteca::where('idBiblioteca', $library->idBiblioteca)->first();

                if (Storage::disk('public')->exists('library/' . $oldfile->ficheiro)) {
                    Storage::disk('public')->delete('library/' . $oldfile->ficheiro);
                }

                $uploadfile = $request->file('ficheiro');
                $file_name = $request->file_name . '('. $library->idBiblioteca.').'.$uploadfile->getClientOriginalExtension();
                $library->ficheiro = $file_name;
                Storage::disk('public')->putFileAs('library/', $uploadfile, $file_name);
                $library->save();
            }

            $library->save();
            return redirect()->route('libraries.index')->with('success', 'Informações do ficheiro editadas com sucesso!');
        } else {
            abort(403);
        }
    }

    public function destroy(Biblioteca $library)
    {
        if (Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin) {
            $oldfile = Biblioteca::where('idBiblioteca', $library->idBiblioteca)->first();

            if (Storage::disk('public')->exists('library/' . $oldfile->ficheiro)) {
                Storage::disk('public')->delete('library/' . $oldfile->ficheiro);
            }
            $library->delete();
            return redirect()->route('libraries.index')->with('success', 'Ficheiro eliminado com sucesso!');
        } else {
            abort(403);
        }
    }
}
