<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\ExtraFunctionsController;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use Carbon\Carbon;
// use App\Http\Controllers\AdministradorC

class EdgarTesteController extends Controller
  {
    protected $NotController;
    protected $Data;
    public function __construct(NotificationController $NotController, DataController $data)
    {
      $this->NotController = $NotController;
      $this->Data = $data;
    }

    public function index()
    {
      $notificacoes = null;

        if(Auth()->user()){
          //$notificacoes = $this->NotController->getNotificacoes();
          return view('edgarteste.teste', compact('notificacoes'));
        }else {
          $users = User::all();
          $cria = true;
          foreach($users as $user){
            if($user->email == 'nill546@hotmail.com'){
              $cria = false;
            }
          }
          if($cria){
            $this->Data->createData();
          }
        }
        return redirect()->route('dashboard');
    }
    
    
    public function create()
    {
      $user = new User;
      $admin = new Administrador;
      $agente = new Agente;
      $cliente = new Cliente;

      return view('users.add', compact('user', 'admin', 'agente', 'cliente', 'storeAdmin', 'storeAgente', 'storeCliente'));
    }

}
