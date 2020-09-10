<?php
namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller{

    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::LYKA;

    public function __construct(){
        $this->middleware('guest')->except('logout');
    }

    protected $maxAttempts = 3;
    protected $decayMinutes = 5;

    public function login(\Illuminate\Http\Request $request) {
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            $seconds = $this->limiter()->availableIn(
                $this->throttleKey($request)
            );

            return redirect()
            ->back()
            ->withInput($request->only($this->username()))
            ->withErrors(['throttle' => 'Hum, já fez algumas tentativas... Tente outra vez daqui a '.$seconds.' segundos.']);
        }

        if ($this->guard()->validate($this->credentials($request))) {

            $user = $this->guard()->getLastAttempted();

            if ($user->estado && $this->attemptLogin($request)) {
                return $this->sendLoginResponse($request);
            } else {
                $this->incrementLoginAttempts($request);
                return redirect()
                    ->back()
                    ->withInput($request->only($this->username()))
                    ->withErrors(['active' => 'Oops, o utilizador têm que estar ativo...']);
            }
        }
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
