<?php
namespace App\Http\Controllers;

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

class UserController extends Controller
{
    public function index()
    {
        $countUser = 0;
        if(Auth()->user()->tipo == 'admin'){
            $Admins = User::all();
            $countAdmin = count($Admins);
        }
        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin)||
            (Auth()->user()->tipo == 'admin' && $countAdmin == 1)){

            $users = User::where('tipo', '=', 'admin')->with('admin')->get();
            return view('users.list', compact('users'));
        }else{
            /* não tem permissões */
            abort(401);
        }
    }

    public function show(User $user)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){
            return view('users.show', compact('user'));
        }else{
            /* não tem permissões */
            abort (401);
        }
    }

    public function create()
    {
        $countUser = 0;
        if(Auth()->user()->tipo == 'admin'){
            $Admins = User::all();
            $countAdmin = count($Admins);
        }
        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin)||
            (Auth()->user()->tipo == 'admin' && $countAdmin == 1)){
            $user = new User;
            return view('users.add', compact('user'));
        }else{
            /* não tem permissões */
            abort (401);
        }
    }

    public function store(StoreUserRequest $requestUser, StoreAdministradorRequest $requestAdmin)
    {
        $countUser = 0;
        if(Auth()->user()->tipo == 'admin'){
            $Admins = User::all();
            $countAdmin = count($Admins);
        }
        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin && Auth()->user()->email != "admin@test.com")||
            (Auth()->user()->tipo == 'admin' && $countAdmin == 1)){
            $fieldsUser = $requestUser->validated();
            $fieldsAdmin = $requestAdmin->validated();

            $user = new User;
            $user->tipo = "admin";
            $user->fill($fieldsUser);

            $admin = new Administrador;
            $admin->fill($fieldsAdmin);

            if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->email == "admin@test.com"){
                $admin->superAdmin = true;
            }

            $name = $admin->nome.' '.$admin->apelido;
            $admin->save();

            $user->idAdmin = $admin->idAdmin;
            $user->email = $admin->email;
            $user->slug = post_slug($name);
            $user->auth_key = strtoupper(random_str(5));
            $user->password = Hash::make(random_str(64));
            $user->save();

            $email = $user->email;
            $auth_key = $user->auth_key;
            dispatch(new SendWelcomeEmail($email, $name, $auth_key));

            return redirect()->route('users.index')->with('success', 'Administrador criado com sucesso.');
        }else{
            /* não tem permissões */
            abort (401);
        }
    }

    public function edit(User $user)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){
            return view('users.edit', compact('user'));
        }else{
            /* não tem permissões */
            abort (401);
        }
    }

    public function update(UpdateUserRequest $requestUser, UpdateAdministradorRequest $requestAdmin, User $user)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){
            $fieldsUser = $requestUser->validated();
            $fieldsAdmin = $requestAdmin->validated();

            $admin = Administrador::where('email', $user->email)->first();

            $user->fill($fieldsUser);
            $admin->fill($fieldsAdmin);
            
            $admin->save();
            $user->save();

            return redirect()->route('users.index')->with('success', 'Administrador atualizado com sucesso.');
        }else{
            /* não tem permissões */
            abort (401);
        }
    }

    public function destroy(User $user)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){
            $user->admin->delete();

            User::where('idUser', $user->idUser)->update([
            'auth_key' => null,
            'estado' => false
            ]);

            $user->delete();
            return redirect()->route('users.index')->with('success', 'Administrador eliminado com sucesso.');
        }else{
            /* não tem permissões */
            abort (401);
        }
    }

    public function print(User $user)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){
            return view('user.print',compact("user"));
        }else{
            /* não tem permissões */
            abort (401);
        }
    }
}
