<?php
namespace App\Http\Controllers;

use DateTime;
use PDF;

use App\User;
use App\Fase;
use App\Agente;
use App\Cliente;
use App\Produto;
use App\Responsabilidade;

use Illuminate\Http\Request;
use App\Jobs\SendWelcomeEmail;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\StoreAgenteRequest;
use App\Http\Requests\UpdateAgenteRequest;


class AgenteController extends Controller
{
    public function index()
    {
        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null) || (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)){
            $agents = null;
            if(Auth()->user()->tipo == 'admin'){
                $agents = Agente::all();
            }else{
                $agents = Agente::where('idAgenteAssociado','=',Auth()->user()->idAgente)->get();
            }
            if($agents || $agents->toArray()){
                $totalagents = $agents->count();
            }else{
                $totalagents = 0;
            }
        }else{
            abort(403);
        }
    return view('agents.list', compact('agents', 'totalagents'));
    }

    public function create()
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){
            $agent = new Agente;
            $listagents = Agente::whereNull('idAgenteAssociado')->get();
            return view('agents.add',compact('agent','listagents'));
        }else{
            abort(403);
        }
    }

    public function store(StoreAgenteRequest $requestAgent, StoreUserRequest $requestUser)
    {
        if (Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){

            /* obtem os dados para criar o agente */
            $agent = new Agente;
            $fields = $requestAgent->validated();
            $agent->fill($fields);
            if($agent->tipo == "Agente"){
                $agent->exepcao = false;
            }

            /* obtem os dados para criar o utilizador */
            $user = new User;
            $fieldsUser = $requestUser->validated();
            $user->fill($fieldsUser);

            /* Criação de SubAgente */
            $agent->idAgenteAssociado= $requestAgent->idAgenteAssociado;

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
            $name = $agent->nome.' '.$agent->apelido;
            $email = $agent->email;
            $auth_key = $user->auth_key;
            // dispatch(new SendWelcomeEmail($email, $name, $auth_key));

            return redirect()->route('agents.index')->with('success', 'Registo criado com sucesso! Aguarda ativação de conta.');

        }else{
            abort(403);
        }
    }


    public function show(Agente $agent)
    {
        if ((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)||
            (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null &&
            (Auth()->user()->idAgente == $agent->idAgenteAssociado||Auth()->user()->idAgente == $agent->idAgente))){

            $listagents = Agente::where('idAgenteAssociado', $agent->idAgente)->get();

            if ($listagents->isEmpty()) {
                $listagents = null;
            }

            if($agent->tipo == "Subagente"){
                $mainAgent = Agente::where('idAgente', $agent->idAgenteAssociado)->first();
            }else {
                $mainAgent = null;
            }

            $telefone2 = $agent->telefone2;
            $IBAN = $agent->IBAN;

            $clients = Cliente::selectRaw("cliente.*")
            ->join('produto', 'cliente.idCliente', 'produto.idCliente')
            ->where('produto.idAgente', $agent->idAgente)
            ->orWhere('produto.idSubAgente', $agent->idAgente)
            ->groupBy('cliente.idCliente')
            ->orderBy('cliente.idCliente','asc')
            ->get();


            if ($clients->isEmpty()) {
                $clients = Cliente::where('idAgente', $agent->idAgente)->get();
            }

            if ($clients->isEmpty()) {
                $clients = null;
            }

            if ($agent->tipo=="Agente") {
                $comissoes = Responsabilidade::where('idAgente', $agent->idAgente)
                ->sum('valorAgente');

            }elseif ($agent->tipo=="Subagente") {
                $comissoes = Responsabilidade::where('idSubAgente', $agent->idAgente)
                ->sum('valorSubAgente');
            }

            $currentdate = new DateTime();

            $produtos = Produto::where('idAgente', $agent->idAgente)->orWhere('idSubAgente', $agent->idAgente)->get();
            $responsabilidadesAgentes = Responsabilidade::where('idAgente', $agent->idAgente)->where('valorAgente', '!=', NULL)->get();
            $responsabilidadesSubAgentes = Responsabilidade::where('idSubAgente', $agent->idAgente)->where('valorSubAgente', '!=', NULL)->get();

            return view('agents.show',compact('currentdate', 'responsabilidadesSubAgentes', 'responsabilidadesAgentes' ,'produtos','agent','listagents','mainAgent','telefone2','IBAN','clients','comissoes'));
        }else{
            abort(403);
        }

    }

    public function edit(Agente $agent)
    {
        if (Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){
            /* lista dos agentes principais */
            $listagents = Agente::
            whereNull('idAgenteAssociado')
            ->get();

            return view('agents.edit', compact('agent','listagents'));
        }else{
            /* não tem permissões */
            abort(403);
        }
    }

    public function update(UpdateAgenteRequest $request, Agente $agent)
    {
        if (Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){
            $fields = $request->validated();
            $agent->fill($fields);

            if($agent->tipo == "Agente"){
                $agent->exepcao = false;
            }

            $oldfile = Agente::where('idAgente', $agent->idAgente)->first();

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
                $agente = Agente::where('idAgente', $agent->idAgente)->first()->update(['idAgenteAssociado' => null]);
            }


            // data em que foi modificado
            $t=time();
            $agent->updated_at == date("Y-m-d",$t);
            $agent->save();

            /* update do user->email */
            $utilizador = User::where('idAgente', $agent->idAgente)->first()->update(['email' => $agent->email]);

            return redirect()->route('agents.index')->with('success', 'Dados do agente modificados com sucesso');
            }else{
                /* não tem permissões */
                abort(403);
            }
    }


    public function destroy(Agente $agent)
    {
        if (Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){
            $agent->delete();
            $subagents = Agente::where('idAgenteAssociado', $agent->idAgente)->get();
            if (!$subagents->isEmpty()) {
                foreach ($subagents as $subagent) {
                    $subagent->deleted_at = $agent->deleted_at;
                    $subagent->save();
                }
            }

            $utilizador = User::where('idAgente', $agent->idAgente)->first()->update(['deleted_at' => $agent->deleted_at]);
            if (!$subagents->isEmpty()) {
                foreach ($subagents as $subagent) {
                    $subagent->deleted_at = $agent->deleted_at;
                    $subagent->save();
                }
            }
            return redirect()->route('agents.index')->with('success', 'Agente eliminado com sucesso!');
        }else{
            abort(403);
        }
    }


    public function printFinanceiro(Request $request, Agente $agente)
    {
        switch ($request->infoPrint) {
            case 'todos':
                $produto = Produto::where("idProduto", $request->produto)->first();
                $fases = Fase::where("idProduto", $request->produto)->get();
                $responsabilidades = [];
                $currentdate = new DateTime();

                foreach ($fases as $fase) {
                    if ($fase->responsabilidade->valorAgente != NULL && $fase->responsabilidade->idAgente == $agente->idAgente) {
                        array_push($responsabilidades, $fase->responsabilidade);
                    }
                }

                $pdf = PDF::loadView('agents.print-financas', ['produto' => $produto, 'agente' => $agente, 'fases' => $fases, 'responsabilidades' => $responsabilidades, 'currentdate' => $currentdate])->setPaper('a4', 'portrait');
                return $pdf->stream('Pagamentos e Cobranças - '.$agente->nome.' '.$agente->apelido.'.pdf');
                break;

            case 'cobrancas':
                $produto = Produto::where("idProduto", $request->produto)->first();
                $fases = Fase::where("idProduto", $request->produto)->get();
                $pdf = PDF::loadView('agents.print-cobrancas', ['produto' => $produto, 'agente' => $agente, 'fases' => $fases])->setPaper('a4', 'portrait');
                return $pdf->stream('Cobranças - '.$agente->nome.' '.$agente->apelido.'.pdf');
                break;

            case 'pagamentos':
                $produto = Produto::where("idProduto", $request->produto)->first();
                $fases = Fase::where("idProduto", $request->produto)->get();
                $responsabilidades = [];
                $currentdate = new DateTime();

                foreach ($fases as $fase) {
                    if ($fase->responsabilidade->valorAgente != NULL && $fase->responsabilidade->idAgente == $agente->idAgente) {
                        array_push($responsabilidades, $fase->responsabilidade);
                    }
                }

                $pdf = PDF::loadView('agents.print-financas', ['produto' => $produto, 'agente' => $agente, 'responsabilidades' => $responsabilidades, 'currentdate' => $currentdate])->setPaper('a4', 'portrait');
                return $pdf->stream('Pagamentos - '.$agente->nome.' '.$agente->apelido.'.pdf');
                break;

            default:
                dd("nok");
                break;
        }
    }
}
