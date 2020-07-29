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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->tipo == "admin" && Auth()->user()->idAdmin != null && Auth()->user()->email != "admin@test.com"){
            $contacts = Contacto::all();
/*             where('Contacto.idUser', '=', Auth::user()->idUser)
            ->get(); */

            return view('contacts.list', compact('contacts'));
        }else{
            abort(401);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Universidade $university=null)
    {
        if (Auth::user()->tipo == "admin" && Auth()->user()->idAdmin != null && Auth()->user()->email != "admin@test.com"){
            $contact = new Contacto;

            return view('contacts.add',compact('contact','university'));
        }else{
            abort(401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactoRequest $request)
    {
        if (Auth::user()->tipo == "admin" && Auth()->user()->idAdmin != null && Auth()->user()->email != "admin@test.com"){
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

            // data em que foi criado
            $t=time();
            $contact->create_at == date("Y-m-d",$t);


            if($request->idUniversidade!=null){
                $contact->idUser = null;
                $contact->idUniversidade=$request->idUniversidade;
            }

            $contact->save();



            if($request->idUniversidade!=null){

                $university=Universidade::
                where('idUniversidade', $request->idUniversidade)
                ->first();

                return redirect()->route('universities.show',$university)->with('success', 'Novo contacto criado com sucesso');

            }else{
                return redirect()->route('contacts.index',$contact)->with('success', 'Novo contacto criado com sucesso');
            }
        }else{
            abort(401);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function show(contacto $contact, Universidade $university=null)
    {

        if (Auth::user()->tipo == "admin" && Auth()->user()->idAdmin != null && Auth()->user()->email != "admin@test.com"){

            /* Se tiver universidade, identifica-a */
            $university=Universidade::where("idUniversidade","=",$contact->idUniversidade)->first();


            return view('contacts.show',compact('contact','university'));
        }else{
            abort(401);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function edit(contacto $contact, Universidade $university=null)
    {
        if (Auth::user()->tipo == "admin" && Auth()->user()->idAdmin != null && Auth()->user()->email != "admin@test.com"){
            return view('contacts.edit', compact('contact','university'));
        }else{
            abort(401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactoRequest $request, contacto $contact)
    {
        if (Auth::user()->tipo == "admin" && Auth()->user()->idAdmin != null && Auth()->user()->email != "admin@test.com"){
            $fields = $request->validated();
            $contact->fill($fields);


            if ($request->hasFile('fotografia')) {
            /* Verifica se o ficheiro antigo existe e apaga do storage*/
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

            // data em que foi modificado
            $t=time();
            $contact->updated_at == date("Y-m-d",$t);

            $contact->save();



            if($request->idUniversidade!=null){

                $university=Universidade::
                where('idUniversidade', $request->idUniversidade)
                ->first();

                return redirect()->route('universities.show',$university)->with('success', 'Informações do contacto alteradas com sucesso');

            }else{
                return redirect()->route('contacts.index',$contact)->with('success', 'Informações do contacto alteradas com sucesso');

            }
        }else{
            abort(401);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function destroy(contacto $contact)
    {
        if (Auth::user()->tipo == "admin" && Auth()->user()->idAdmin != null && Auth()->user()->email != "admin@test.com"){
            $contact->delete();
            return back()->with('success', 'Contacto eliminado com sucesso');
        }else{
            abort(401);
        }
    }
}
