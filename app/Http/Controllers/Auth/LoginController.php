<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/client/application-form';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return Inertia::render('Auth/Login');
    }

    public function username()
    {
        return 'email';
    }

    public function validateLogin(\Illuminate\Http\Request $request)
    {
        $request->validate([
            $this->username() => 'bail|required|exists:App\User,email',
            'password' => 'bail|required',
        ]);
    }

    public function logout(\Illuminate\Http\Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 204)
            : Redirect::route('home');
    }

    public function authenticated(\Illuminate\Http\Request $request, \App\User $user)
    {
        switch($request->user()->role) {
            case 'client':
                if ($request->user()->isFilled) {
                    return redirect()->route('cl.dashboard');
                } else {
                    return redirect()->route('cl.application');
                }
            break;

            case 'moderator':
                return redirect()->route('md.dashboard');
            break;

            case 'superadministrator':
                return redirect()->route('sa.dashboard');
            break;
        }
    }
}
