<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\OnlineProgram;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['bail', 'required', 'string', 'email:rfc,dns', 'max:255', 'unique:users'],
            'password' => ['bail', 'required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' =>  ['required'],
            'program'   =>  ['required']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role'  =>  'client',
            'isFilled'  =>  false,
            'program'   =>  $data['program']
        ]);
    }

    public function showRegistrationForm()
    {
        return Inertia::render('Auth/Register', [
            'online_programs'   =>  OnlineProgram::orderBy('id')->get()
        ]);
    }

    // public function register(\Illuminate\Http\Request $request)
    // {
    //     $request->validate([
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);

    //     User::create([
    //         'email' => $request->input('email'),
    //         'password' => Hash::make($request->input('password')),
    //         'role'  =>  'client',
    //         'isFilled'  =>  false,
    //     ]);

    //     return Redirect::route('login')->with('message', 'We have sent you a email verification to activate your account.');
    // }
}
