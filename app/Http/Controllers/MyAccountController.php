<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MyAccountController extends Controller
{
    public function show()
    {
        $data['pageTitle'] = 'Mi cuenta';

        return view('my_account', $data);
    }

    public function updateAccount(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'unique:users,email,' .$request->id],
            'username' => ['required', 'string', 'max:20', 'unique:users,username,' .$request->id],
        ];

        $customMessages = [
            'name.required' => 'Nombre es requerido',
            'email.required' => 'Email es requerido',
            'email.unique' => 'Email ya existe, escoja otro.',
            'username.required' => 'Usuario es requerido.',
            'username.unique' => 'Usuario ya existe, escoja otro.',
        ];

        $this->validate($request, $rules, $customMessages);

        $user = User::find($request->id);
        $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username
            ]);

        return redirect('/my-account')->with('message', 'Los datos han sido actulizados correctamente.');
    }

    public function updatePassword(Request $request)
    {
        $rules = [
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required', 'min:8', 'regex:/^.*(?=.{3,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\d\x]).*$/'],
            'new_password_confirmation' => ['same:new_password'],
        ];

        $customMessages = [
            'current_password.required' => 'Contraseña antigua es requerida.',
            'new_password.required' => 'Nueva cotraseña es requerida',
            'new_password.min' => 'Contraseña debe contar con un mínimo de :min catacteres.',
            'new_password.regex' => 'La contraseña debe contener letras mayúsculas, minúsculas y números.',
            'new_password_confirmation.same' => 'Las contaseñas no coinciden.',
        ];

        $this->validate($request, $rules, $customMessages);

        $user = User::find($request->id);
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect('/my-account')->with('message', 'La contraseña ha sido actualizada correctamente.');
    }
}
