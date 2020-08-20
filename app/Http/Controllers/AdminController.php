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
            /* não tem permissões */
            abort(401);
        }
    }

    public function show(Administrador $admin)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){
            return view('admins.show', compact('admin'));
        }else{
            /* não tem permissões */
            abort (401);
        }
    }

    public function create()
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){
            $admin = new Administrador;
            return view('admins.add', compact('admin'));
        }else{
            /* não tem permissões */
            abort (401);
        }
    }

    public function store(StoreAdministradorRequest $requestAdmin)
    {
        $countUser = 0;
        if(Auth()->user()->tipo == 'admin'){
            $Admins = Administrador::all();
            $countAdmin = count($Admins);
        }
        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com")||
            (Auth()->user()->tipo == 'admin' && $countAdmin == 1)){
            $fieldsAdmin = $requestAdmin->validated();

            $admin = new Administrador;
            $admin->fill($fieldsAdmin);

            $user = new User;
            $user->tipo = "admin";

            if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->email == "admin@test.com"){
                $admin->superAdmin = true;
            }

            $admins = Administrador::withTrashed()->get();
            foreach ($admins as $trash){
                if($trash->email == $admin->email){
                    return redirect()->back()->withInput();
                }
            }
            $users = User::withTrashed()->get();
            foreach ($users as $trash){
                if($trash->email == $admin->email){
                    return redirect()->back()->withInput();
                }
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

            return redirect()->route('admins.index')->with('success', 'Administrador criado com sucesso.');
        }else{
            /* não tem permissões */
            abort (401);
        }
    }

    public function edit(Administrador $admin)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){
            return view('admins.edit', compact('admin'));
        }else{
            /* não tem permissões */
            abort (401);
        }
    }

    public function update(UpdateAdministradorRequest $requestAdmin, Administrador $admin)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){
            $fieldsAdmin = $requestAdmin->validated();

            $admin->fill($fieldsAdmin);
            $user = $admin->user;

            
            $admins = Administrador::withTrashed()->get();
            foreach ($admins as $trash){
                if($trash->email == $admin->email){
                    return redirect()->back()->withInput();
                }
            }
            $users = User::withTrashed()->get();
            foreach ($users as $trash){
                if($trash->email == $admin->email && $trash->idAdmin != $admin->idAdmin){
                    return redirect()->back()->withInput();
                }
            }

            $admin->save();
            $user->save();

            return redirect()->route('admins.index')->with('success', 'Administrador atualizado com sucesso.');
        }else{
            /* não tem permissões */
            abort (401);
        }
    }

    public function destroy(Administrador $admin)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){
            $user->admin->delete();

            User::where('idUser', $admin->user->idUser)->update([
            'auth_key' => null,
            'estado' => false
            ]);

            $user->delete();
            return redirect()->route('admins.index')->with('success', 'Administrador eliminado com sucesso.');
        }else{
            /* não tem permissões */
            abort (401);
        }
    }

    public function print(Administrador $admin)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com"){
            return view('admins.print',compact("admin"));
        }else{
            /* não tem permissões */
            abort (401);
        }
    }
}
