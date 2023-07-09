<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $this->validate($request,
        [
            'name' => ['required', 'min:3', 'max:20'],
            'username' => ['required', 'unique:users', 'min:3', 'max:15'],
            'email' => ['required', 'unique:users', 'email', 'max:30'],
            'password' => ['required', 'confirmed', 'min:8']
        ],
        [
            'required' => 'Este campo es requerido',
            'unique' => 'Este correo ya existe',
            'min' => 'Minimo de :min caracteres',
            'max' => 'Maximo de :max caracteres',
            'email' => 'Email no válido',
            'Confirmed' => 'Las contraseñas no coinciden'
        ]);
    }



}
