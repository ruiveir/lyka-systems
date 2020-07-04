<?php
namespace App\Http\Controllers;

use App\User;
use App\Agente;
use App\Cliente;
use App\Administrador;
use Illuminate\Http\Request;
use App\Jobs\RestoreAccount;
use App\Jobs\RestorePassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AccountConfirmationController extends Controller
{
    public function index(Request $request, User $user)
    {
      if ($user->estado == true) {
          abort(403);
      }elseif($user->auth_key == null) {
          return view('auth.account-inactive', compact('user'));
      }else {
          return view('auth.confirmation-key', compact('user'));
      }
    }

    public function keyconfirmation(Request $request, User $user)
    {
      $auth_key = $request->only('key');

      if ($user->auth_key == $auth_key['key']) {
          return view('auth.confirmation-password', compact('user'));
      }else {
          $error = "O código de autenticação que introduziu é inválido.";
          return view('auth.confirmation-key', compact('user', 'error'));
      }
    }

    public function password(Request $request, User $user)
    {
      $password = $request->input('password');
      $passwordConf = $request->input('password-confirmation');

      if ($password == $passwordConf) {
          $hashed = Hash::make($password);
          $user->password = $hashed;
          $user->estado = true;
          $user->save();
          if (Auth::check()) {
              Auth::logout();
          }
          return view('auth.accountactive', compact('user'));
      }else {
          $error = "As palavras-chaves não coincidem. Verifique a sua inserção.";
          return view('auth.confirmation-password', compact('user', 'error'));
      }
    }

    public function restore(Request $request, User $user)
    {
        $email = $request->only('email');

        if ($email['email'] == $user->email) {
            $auth_key = strtoupper(random_str(5));
            User::where('idUser', $user->idUser)->update(['auth_key' => $auth_key]);
            $email = $user->email;
            if ($user->tipo == 'admin') {
                $name = $user->admin->nome.' '.$user->admin->apelido;
            }elseif ($user->tipo == 'agente') {
                $name = $user->agente->nome.' '.$user->agente->apelido;
            }else {
                $name = $user->cliente->nome.' '.$user->cliente->apelido;
            }
            dispatch(new RestoreAccount($email, $name, $auth_key));
            return redirect()->route('confirmation.index', $user);
        }else {
            $error = "O e-mail que inseriu não correspodem ao registado no sistema.";
            return view('auth.account-inactive', compact('user', 'error'));
        }
    }

    public function mailrestorepassword()
    {
        return view('auth.mail-password');
    }

    public function checkemail(Request $request)
    {
        $email = $request->input('email');
        $users = User::where('email', $email)
        ->where(function($users){
            $users->where('auth_key', '!=', null)
            ->where('estado', 1);
        })->first();

        if ($users == null) {
            return response()->json('NOK', 500);
        }

        switch ($users->tipo) {
            case 'admin':
                $user = Administrador::where('idAdmin', $users->idAdmin)
                ->select('nome', 'apelido', 'telefone1', 'email')
                ->first();
            break;

            case 'agente':
                $user = Agente::where('idAgente', $users->idAgente)
                ->select('nome', 'apelido', 'telefone1', 'email')
                ->first();
            break;

            case 'cliente':
                $user = Cliente::where('idCliente', $users->idCliente)
                ->select('nome', 'apelido', 'telefone1', 'email')
                ->first();
            break;
        }

        return $user->toJson();
    }

    public function checkphone(Request $request)
    {
        $codephone = $request->input('code');
        $email = $request->input('email');
        $phone = $request->input('phone');

        $phone = str_split($phone);

        for ($i=0; $i < 3; $i++) {
            array_pop($phone);
        }

        $phone = implode('', $phone);
        $phoneNumber = $phone.$codephone;

        $users = User::where('email', $email)->first();

        switch ($users->tipo) {
            case 'admin':
                $user = Administrador::where('idAdmin', $users->idAdmin)->first();
            break;

            case 'agente':
                $user = Agente::where('idAgente', $users->idAgente)->first();
            break;

            case 'cliente':
                $user = Cliente::where('idCliente', $users->idCliente)->first();
            break;
        }

        $email = $user->email;
        $name = $user->nome.' '.$user->apelido;

        if ($user->telefone1 == $phoneNumber) {
            $users->update(['password' => null]);
            dispatch(new RestorePassword($email, $name));
            return response()->json('OK', 200);
        }else {
            return response()->json('NOK', 500);
        }
    }

    public function restorepassword(User $user)
    {
        $password = User::where('idUser', $user->idUser)->select('password')->first();
        $user = User::where('idUser', $user->idUser)->select('idUser', 'email', 'slug')->first();
        if ($password->password == null) {
            return view('auth.restore-password', compact('user'));
        }else {
            abort(403);
        }
    }

    public function checkuser(Request $request)
    {
        $id = $request->input('id');
        $email = $request->input('email');

        $password = User::where('email', $email)
        ->where(function($user){
            $user->where('auth_key', '!=', null)
            ->where('estado', 1);
        })->select('password')->first();

        $user = User::where('email', $email)
        ->where(function($user){
            $user->where('auth_key', '!=', null)
            ->where('estado', 1);
        })->select('idUser', 'email', 'slug')->first();

        if ($password->password != null) {
            abort(403);
        }

        if ($email == $user->email && $user != null) {
            return response()->json($user, 200);
        }else {
            return response()->json('NOK', 500);
        }
    }

    public function checkpassword(Request $request)
    {
        $id = $request->input('id');
        $password = $request->input('password');
        $passwordconf = $request->input('passwordconf');

        if ($password == $passwordconf) {
            User::where('idUser', $id)->update(['password' => Hash::make($password)]);
            if (Auth::check()) {
                Auth::logout();
            }
            return response()->json('OK', 200);
        }else {
            return response()->json('NOK', 500);
        }
    }

    public function loginVerificationView(User $user){

        return view('auth.login-verification', compact('user'));

    }

    public function loginVerification(Request $request, User $user){
        $code = $request->input('code');

        if ($code == $user->login_key) {
            return redirect()->route('dashboard');
        }else {
            $error = "O código de autenticação que introduziu é inválido.";
            return view('auth.login-verification', compact('user', 'error'));
        }
    }
}
