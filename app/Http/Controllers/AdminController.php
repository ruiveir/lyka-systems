<?php
namespace App\Http\Controllers;

use Session;
use App\User;
use App\Administrador;
use Illuminate\Http\Request;
use App\Jobs\SendWelcomeEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\StoreAdministradorRequest;
use App\Http\Requests\UpdateAdministradorRequest;

class AdminController extends Controller
{
    public function index()
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){
            $admins = Administrador::all();
            return view('admins.list', compact('admins'));
        }else{
            abort(403);
        }
    }

    public function show(Administrador $admin)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){
            return view('admins.show', compact('admin'));
        }else{
            abort(403);
        }
    }

    public function create()
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){
            $admin = new Administrador;
            return view('admins.add', compact('admin'));
        }else{
            abort(403);
        }
    }

    public function store(StoreAdministradorRequest $requestAdmin)
    {
        $countUser = 0;
        if(Auth()->user()->tipo == 'admin'){
            $Admins = Administrador::all();
            $countAdmin = count($Admins);
        }
        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin) || (Auth()->user()->tipo == 'admin' && $countAdmin == 1)){
            $fieldsAdmin = $requestAdmin->validated();

            $admin = new Administrador;
            $admin->fill($fieldsAdmin);

            $user = new User;
            $user->tipo = "admin";

            if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null){
                $admin->superAdmin = true;
            }

            $admin->save();

            $name = $admin->nome.' '.$admin->apelido;
            $user->idAdmin = $admin->idAdmin;
            $user->email = $admin->email;
            $user->slug = post_slug($name);
            $user->auth_key = strtoupper(random_str(5));
            $user->password = Hash::make(random_str(64));
            $user->save();

            dispatch(new SendWelcomeEmail($user->email, $name, $user->auth_key));

            return redirect()->route('admin.index')->with('success', 'Administrador criado com sucesso.');
        }else{
            abort(403);
        }
    }

    public function edit(Administrador $admin)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){
            return view('admins.edit', compact('admin'));
        }else{
            abort(403);
        }
    }

    public function update(UpdateAdministradorRequest $requestAdmin, Administrador $admin)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){
            $fieldsAdmin = $requestAdmin->validated();

            $admin->fill($fieldsAdmin);
            $user = $admin->user;
            $admin->save();
            $user->save();

            return redirect()->route('admin.index')->with('success', 'Administrador atualizado com sucesso.');
        }else{
            abort(403);
        }
    }

    public function destroy(Administrador $admin)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){
            $user->admin->delete();

            User::where('idUser', $admin->user->idUser)->update([
                'auth_key' => null,
                'estado' => false
            ]);

            $user->delete();
            return redirect()->route('admin.index')->with('success', 'Administrador eliminado com sucesso.');
        }else{
            abort(403);
        }
    }
}
