<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            $user = $this->guard()->user();
            $expectedRole = $request->input('role_login');

            if (
                ($expectedRole === 'asesi' && !$user->hasRole('asesi')) ||
                ($expectedRole === 'admin' && !$user->hasRole('admin'))
            ) {
                $this->guard()->logout();
                $this->incrementLoginAttempts($request);
                return $this->sendFailedLoginResponse($request);
            }

            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->hasRole('admin')) {
            return redirect()->route('admin');
        }
        if ($user->hasRole('asesor')) {
            return redirect()->route('dashboard.asesor');
        }
        if ($user->hasRole('asesi')) {
            return redirect()->route('asesion');
        }
        return redirect()->route('/');
    }
}
