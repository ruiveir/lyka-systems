<?php

namespace App\Http\Controllers;

use App\Agente;
use App\User;
use App\Cliente;
use App\Responsabilidade;
use App\Produto;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Hash;

use App\Jobs\SendWelcomeEmail;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateAgenteRequest;
use App\Http\Requests\StoreAgenteRequest;
use App\Http\Requests\StoreUserRequest;

use App\Http\Requests\UpdateUserRequest;


class AgenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        /* Permissões */
        if ((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->email != "admin@test.com")||(Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)){
            $agents =null;
            if(Auth()->user()->tipo == 'admin'){
                $agents = Agente::all();
            }else{
                $agents = Agente::where(['idAgenteAssociado','=',Auth()->user()->idAgente],['tipo','like','Subagente'])->get();
            }
            if($agents || $agents->toArray()){
                $totalagents = $agents->count();
            }else{
                $totalagents = 0;
            }

        }else{
            abort (401);
        }
            return view('agents.list', compact('agents', 'totalagents'));

    return view('agents.list', compact('agents', 'totalagents'));

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){
            $agent = new Agente;

            /* lista dos agentes principais */
            $listagents = Agente::
            whereNull('idAgenteAssociado')
            ->get();

            return view('agents.add',compact('agent','listagents'));

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
    public function store(StoreAgenteRequest $requestAgent, StoreUserRequest $requestUser)
    {
        if (Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){

            /* obtem os dados para criar o agente */
            $agent = new Agente;
            $fields = $requestAgent->validated();
            $agent->fill($fields);
            if($agent->tipo == "Agente"){
                $agent->exepcao = false;
                $agent->tipo = 'Subagente';
            }

            /* obtem os dados para criar o utilizador */
            $user = new User;
            $fieldsUser = $requestUser->validated();
            $user->fill($fieldsUser);



            /* Criação de SubAgente */
            $agent->idAgenteAssociado= $requestAgent->idAgenteAssociado;

            // data em que foi criado
            $t=time();
            $agent->create_at == date("Y-m-d",$t);

            /* Slugs */
            $agent->slug = post_slug($agent->nome.' '.$agent->apelido);

            $agent->save();

            /* Fotografia do agente */
            if ($requestAgent->hasFile('fotografia')) {
                $photo = $requestAgent->file('fotografia');
                $profileImg = $agent->idAgente .'.'. $photo->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('agent-documents/'.$agent->idAgente.'/', $photo, $profileImg);
                $agent->fotografia = $profileImg;
                $agent->save();
            }



            /* Documento de identificação */
            if ($requestAgent->hasFile('img_doc')) {
                $docfile = $requestAgent->file('img_doc');
                $docImg = $agent->idAgente. '_DocID'.  '.' . $docfile->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('agent-documents/'.$agent->idAgente.'/', $docfile, $docImg);
                $agent->img_doc = $docImg;
                $agent->save();
            }



            /* Criação de utilizador */

            $user->tipo = "agente";
            $user->idAgente = $agent->idAgente;
            $user->slug = post_slug($agent->nome.' '.$agent->apelido);
            $user->auth_key = strtoupper(random_str(5));
            $password = random_str(64);
            $user->password = Hash::make($password);

            $user->save();

            /* Envia o e-mail para ativação */
            $name = $agent->nome .' '. $agent->apelido;
            $email = $agent->email;
            $auth_key = $user->auth_key;
            dispatch(new SendWelcomeEmail($email, $name, $auth_key));

            return redirect()->route('agents.index')->with('success', 'Registo criado com sucesso. Aguarda Ativação');

        }else{
            /* não tem permissões */
            abort (401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agente  $agent
     * @return \Illuminate\Http\Response
     */
    public function show(Agente $agent)
    {
        /* Permissões */
        if ((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->email != "admin@test.com")||
            (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null &&
            (Auth()->user()->idAgente == $agent->idAgenteAssociado||Auth()->user()->idAgente == $agent->idAgente))){

            /* Só os administradores podem ver os perfis dos agentes */
            /* Cada agente só pode ver o seu perfil *//*
            if(Auth::user()->tipo == "agente" && Auth::user()->idAgente != $agent->idAgente){
                abort(401);
            }/** */

            /* Lista de sub-agentes do $agente */
            $listagents = Agente::
            where('idAgenteAssociado', '=',$agent->idAgente)
            ->get();

            if ($listagents->isEmpty()) {
                $listagents=null;
            }


    /*       caso seja um sub-agente, obtem o agente que o adicionou */
            if($agent->tipo=="Subagente"){
                $mainAgent=Agente::
                where('idAgente', '=',$agent->idAgenteAssociado)
                ->first();
            }else{
                $mainAgent=null;
            }

            $telefone2 = $agent->telefone2;
            $IBAN = $agent->IBAN;


            /* lista de alunos do agente Através de produtos  */
        $clients = Cliente::
            selectRaw("Cliente.*")
            ->join('Produto', 'Cliente.idCliente', '=', 'Produto.idCliente')
            ->where('Produto.idAgente', '=', $agent->idAgente)
            ->orWhere('Produto.idSubAgente', '=', $agent->idAgente)
            ->groupBy('Cliente.idCliente')
            ->orderBy('Cliente.idCliente','asc')
            ->get();
            

            if ($clients->isEmpty()) {
            /* lista de alunos do agente associação na ficha de cliente  */
            $clients = Cliente::
            where('idAgente', '=', $agent->idAgente)
            ->get();
            }

            if ($clients->isEmpty()) {
                $clients=null;
            }


            /* Valor total das comissões */

            /* Caso seja do tipo Agente */
            if ($agent->tipo=="Agente"){
                $comissoes = Responsabilidade::
                where('idAgente', '=', $agent->idAgente)
                ->sum('valorAgente');

            }elseif($agent->tipo=="Subagente"){
                $comissoes = Responsabilidade::
                where('idSubAgente', '=', $agent->idAgente)
                ->sum('valorSubAgente');
            }

            return view('agents.show',compact("agent" ,'listagents','mainAgent','telefone2','IBAN','clients','comissoes'));
        }else{
            abort(401);
        }

    }


   /**
    * Prepares document for printing the specified agent.
    *
    * @param  \App\Agente  $agent
    * @return \Illuminate\Http\Response
    */
    public function print(Agente $agent)
    {
        /* Permissões */
        if ((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->email != "admin@test.com")||
            (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null &&
            (Auth()->user()->idAgente == $agent->idAgenteAssociado||Auth()->user()->idAgente == $agent->idAgente))){
            return view('agents.print',compact("agent"));
        }else{
            abort(401);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agente  $agent
     * @return \Illuminate\Http\Response
     */
    public function edit(Agente $agent)
    {
        if (Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){
            /* lista dos agentes principais */
            $listagents = Agente::
            whereNull('idAgenteAssociado')
            ->get();

            return view('agents.edit', compact('agent','listagents'));
        }else{
            /* não tem permissões */
            abort (401);
        }
    }





    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agente  $agent
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAgenteRequest $request, Agente $agent)
    {
        if (Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){

            $fields = $request->validated();

            $agent->fill($fields);


            /* Definição de exeçao */
            if($agent->tipo == "Agente"){
                $agent->exepcao = false;
            }


            /* Registo antigo: para verificar se existem ficheiros para apagar/substituir */
            $oldfile=Agente::
            where('idAgente', '=',$agent->idAgente)
            ->first();


            /* Fotografia */
            if ($request->hasFile('fotografia')) {

                /* Verifica se o ficheiro antigo existe e apaga do storage*/
                if(Storage::disk('public')->exists('agent-documents/'.$agent->idAgente.'/' . $oldfile->fotografia)){
                    Storage::disk('public')->delete('agent-documents/'.$agent->idAgente.'/' . $oldfile->fotografia);
                }

            /* Guarda a nova fotografia */
                $photo = $request->file('fotografia');
                $profileImg = $agent->idAgente .'.'. $photo->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('agent-documents/'.$agent->idAgente.'/', $photo, $profileImg);
                $agent->fotografia = $profileImg;
            }





            /* Documento de identificação */
            if ($request->hasFile('img_doc')) {

            /* Verifica se o ficheiro antigo existe e apaga do storage*/
            if(Storage::disk('public')->exists('agent-documents/'.$agent->idAgente.'/' . $oldfile->img_doc)){
                Storage::disk('public')->delete('agent-documents/'.$agent->idAgente.'/' . $oldfile->img_doc);
            }

                $docfile = $request->file('img_doc');
                $docImg = $agent->idAgente. '_DocID'.  '.' . $docfile->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('agent-documents/'.$agent->idAgente.'/', $docfile, $docImg);
                $agent->img_doc = $docImg;
            }


            // Caso se mude o  agente para subagente, garante que nenhum agente não tem id de subagente
            if($request->idAgenteAssociado == null){
            DB::table('Agente')
            ->where('idAgente', $agent->idAgente)
            ->update(['idAgenteAssociado' => null]);
            }



            /* Update das slugs */
            $agent->slug = post_slug($agent->nome.' '.$agent->apelido);

            // data em que foi modificado
            $t=time();
            $agent->updated_at == date("Y-m-d",$t);
            $agent->save();

            /* update do user->email */
            DB::table('User')
            ->where('idAgente', $agent->idAgente)
            ->update(['email' => $agent->email]);


            return redirect()->route('agents.show',$agent)->with('success', 'Dados do agente modificados com sucesso');
            }else{
                /* não tem permissões */
                abort (401);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agente  $agent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agente $agent)
    {
        if (Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){
        
            /* "Apaga" dos agentes */
            $agent->delete();


            /* Apaga subagentes se o seu agente for apagado */
            $subagents =DB::table('Agente')
            ->where('idAgenteAssociado', $agent->idAgente)
            ->get();

            /* apaga a lista de subagentes do agente que esta a ser apagado */
            if (!$subagents->isEmpty()) {
                foreach ($subagents as $subagent) {
                    DB::table('Agente')
                    ->where('idAgenteAssociado', $agent->idAgente)
                    ->update(['deleted_at' => $agent->deleted_at]);
                }
            }



            /* "Apaga" dos utilizadores */
            DB::table('User')
            ->where('idAgente', $agent->idAgente)
            ->update(['deleted_at' => $agent->deleted_at]);


            /* "Apaga" dos utilizadores os subagentes que tiveram o seu agente apagado */

            /* apaga a lista de subagentes do agente que esta a ser apagado */
            if (!$subagents->isEmpty()) {
                foreach ($subagents as $subagent) {
                    DB::table('User')
                    ->where('idAgente', '=', $subagent->idAgente)
                    ->update(['deleted_at' => $agent->deleted_at]);
                }
            }


            return redirect()->route('agents.index')->with('success', 'Agente eliminado com sucesso');
        }else{
            /* não tem permissões */
            abort (401);
        }
    }
}
