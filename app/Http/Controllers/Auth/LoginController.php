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

    public function login(\Illuminate\Http\Request $request) {
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if ($this->guard()->validate($this->credentials($request))) {

            $user = $this->guard()->getLastAttempted();

            if ($user->estado && $this->attemptLogin($request)) {
                return $this->sendLoginResponse($request);
            } else {
                $this->incrementLoginAttempts($request);
                return redirect()
                    ->back()
                    ->withInput($request->only($this->username(), 'remember'))
                    ->withErrors(['active' => 'You must be active to login.']);
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
