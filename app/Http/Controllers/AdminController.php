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
    public function __construct()
    {
        $this->middleware('superadmin');
    }

    public function index()
    {
        $admins = Administrador::all();
        return view('admins.list', compact('admins'));
    }

    public function show(Administrador $admin)
    {
        return view('admins.show', compact('admin'));
    }

    public function create()
    {
        $admin = new Administrador;
        return view('admins.add', compact('admin'));
    }

    public function store(StoreAdministradorRequest $requestAdmin)
    {
        $countUser = 0;

        if(Auth()->user()->tipo == 'admin'){
            $Admins = Administrador::all();
            $countAdmin = count($Admins);
        }

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
    }

    public function edit(Administrador $admin)
    {
        return view('admins.edit', compact('admin'));
    }

    public function update(UpdateAdministradorRequest $requestAdmin, Administrador $admin)
    {
        $fieldsAdmin = $requestAdmin->validated();
        $admin->fill($fieldsAdmin);
        $user = $admin->user;
        $admin->save();
        $user->save();
        return redirect()->route('admin.index')->with('success', 'Administrador atualizado com sucesso.');
    }

    public function destroy(Administrador $admin)
    {
        $admin->user->forceDelete();
        $admin->delete();
        return redirect()->route('admin.index')->with('success', 'Administrador eliminado com sucesso.');
    }
}
