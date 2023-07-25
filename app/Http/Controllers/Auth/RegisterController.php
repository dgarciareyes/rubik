<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
        $rules = [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'username' => ['required', 'max:20', 'unique:users'],
            'password' => ['required', 'min:8', 'regex:/^.*(?=.{3,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\d\x]).*$/', 'confirmed'],
        ];

        $customMessages = [
            'name.required' => 'Nombre es requerido.',
            'email.required' => 'Email es requerido',
            'email.email' => 'Email no válido.',
            'email.unique' => 'Email ya existe, escoja otro.',
            'username.required' => 'Usuario es requerido',
            'username.max' => 'Usuario debe contener un máximo de :max caracteres.',
            'username.unique' => 'Usuario ya existe, escoja otro.',
            'password.required' => 'Contraseña es requerida',
            'password.min' => 'Contraseña debe contar con un mínimo de :min caracteres.',
            'password.regex' => 'La contraseña debe contener letras mayúsculas, minúsculas y números.',
            'password.confirmed' => 'Las contraseñas no coinciden',
        ];

        return Validator::make($data, $rules, $customMessages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);

        // return $user->assignRole('administrator');
    }
}
