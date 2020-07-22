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
          return view('auth.activate-account', compact('user'));
      }
    }

    public function keyconfirmation(Request $request, User $user)
    {
      $auth_key = $request->input('code');

      if ($user->auth_key == $auth_key) {
          return response()->json('OK', 200);
      }else {
          return response()->json('NOK', 500);
      }
    }

    public function password(Request $request, User $user)
    {
      $password = $request->input('password');

      $hashed = Hash::make($password);
      $user->password = $hashed;
      $user->estado = true;
      $user->save();

      if (Auth::check()) {
          Auth::logout();
      }

      return response()->json('OK', 200);
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
        $user = User::where('email', $email)->with("admin", "agente", "cliente")->first();
        $auth_key = $user->auth_key;

        if ($user != null) {
            switch ($user->tipo) {
                case 'admin':
                    $name = $user->admin->nome.' '.$user->admin->apelido;
                    break;
                case 'agente':
                    $name = $user->agente->nome.' '.$user->agente->apelido;
                    break;
                case 'cliente':
                    $name = $user->cliente->nome.' '.$user->cliente->apelido;
                    break;
            }
            dispatch(new RestorePassword($email, $name, $auth_key));
            return response()->json('OK', 200);
        }else {
            return response()->json('NOK', 500);
        }
    }

    public function restorepassword(User $user)
    {
        $user = User::where('idUser', $user->idUser)->select('idUser', 'email', 'slug')->first();
        return view('auth.restore-password', compact('user'));
    }

    public function checkkey(Request $request, User $user)
    {
        $code = $request->input('code');

        if ($user->auth_key == $code) {
            return response()->json("OK", 200);
        }else {
            return response()->json("NOK", 500);
        }
    }

    public function newpassword(Request $request, User $user)
    {
        $password = $request->input("password");
        $hashed = Hash::make($password);
        $user->password = $hashed;
        $user->estado = true;
        $user->save();

        if (Auth::check()) {
            Auth::logout();
        }

        return response()->json("OK", 200);
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
