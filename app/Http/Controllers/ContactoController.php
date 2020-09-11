<?php

namespace App\Http\Controllers;

use App\Contacto;
use App\Universidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateContactoRequest;
use App\Http\Requests\StoreContactoRequest;

class ContactoController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $contacts = Contacto::all();
        $favorito = false;
        return view('contacts.list', compact('contacts','favorito'));
    }

    public function favoritos()
    {
        $contacts = Contacto::where("favorito", "1")->get();
        $favorito = true;
        return view('contacts.list', compact('contacts','favorito'));
    }

    public function create(Universidade $university = null)
    {
        $contact = new Contacto;
        return view('contacts.add',compact('contact','university'));
    }

    public function store(StoreContactoRequest $request)
    {
        $fields = $request->validated();
        $contact = new Contacto;
        $contact->fill($fields);

        if ($request->hasFile('fotografia')) {
            $photo = $request->file('fotografia');
            $profileImg = $contact->nome . '_' . time() . '.' . $photo->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('contact-photos/', $photo, $profileImg);
            $contact->fotografia = $profileImg;
        }

        $contact->idUser = Auth::user()->idUser;

        if($request->idUniversidade != null){
            $contact->idUser = null;
            $contact->idUniversidade = $request->idUniversidade;
        }

        $contact->save();

        if($request->idUniversidade != null){
            $university = Universidade::where('idUniversidade', $request->idUniversidade)->first();
            return redirect()->route('universities.show', $university)->with('success', 'Novo contacto criado com sucesso!');
        }else{
            return redirect()->route('contacts.index', $contact)->with('success', 'Novo contacto criado com sucesso!');
        }
    }

    public function show(contacto $contact)
    {
        $university = Universidade::where("idUniversidade", $contact->idUniversidade)->first();
        return view('contacts.show',compact('contact','university'));
    }

    public function edit(contacto $contact, Universidade $university=null)
    {
        return view('contacts.edit', compact('contact','university'));
    }

    public function update(UpdateContactoRequest $request, contacto $contact)
    {
        $fields = $request->validated();
        $contact->fill($fields);

        if ($request->hasFile('fotografia')) {
            $oldfile=Contacto::where('idContacto', '=',$contact->idContacto)->first();

            if(Storage::disk('public')->exists('contact-photos/'. $oldfile->fotografia)){
                Storage::disk('public')->delete('contact-photos/'. $oldfile->fotografia);
            }

            $photo = $request->file('fotografia');
            $profileImg = $contact->nome . '_' . time() . '.' . $photo->getClientOriginalExtension();

            if (!empty($contact->fotografia)) {
                Storage::disk('public')->delete('contact-photos/' . $contact->fotografia);
            }

            Storage::disk('public')->putFileAs('contact-photos/', $photo, $profileImg);
            $contact->fotografia = $profileImg;
        }

        $contact->save();

        if($request->idUniversidade!=null){
            $university=Universidade::where('idUniversidade', $request->idUniversidade)->first();
            return redirect()->route('universities.show',$university)->with('success', 'Informações do contacto alteradas com sucesso!');
        }else{
            return redirect()->route('contacts.index',$contact)->with('success', 'Informações do contacto alteradas com sucesso!');
        }
    }

    public function destroy(contacto $contact)
    {
        $contact->delete();
        return back()->with('success', 'Contacto eliminado com sucesso!');
    }
}
