<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {

        // Modificar el request para que entre en la validacion de username.unique
        $request->request->add(['username' => Str::slug( $request->username )]);


        $this->validate($request,
        [
            'name' => ['required', 'min:3', 'max:20'],
            'username' => ['required', 'unique:users', 'min:3', 'max:15'],
            'email' => ['required', 'unique:users', 'email', 'max:30'],
            'password' => ['required', 'confirmed', 'min:8']
        ],
        [
            'required' => 'Este campo es requerido',
            'email.unique' => 'Este correo ya esta en uso',
            'username.unique' => 'Ya existe este username',
            'min' => 'Minimo de :min caracteres',
            'max' => 'Maximo de :max caracteres',
            'email' => 'Email no válido',
            'confirmed' => 'Las contraseñas no coinciden'
        ]);



        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make( $request->password )
        ]);


        // Intentar inicio de sesion
        auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);


        return redirect()->route('posts.index', ['user' => auth()->user()]);
    }



}
