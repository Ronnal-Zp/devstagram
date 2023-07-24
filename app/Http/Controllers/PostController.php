<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(User $user)
    {
        return view('dashboard', [
            'user' => $user,
        ]);
    }


    public function create()
    {
        return view('posts.create');
    }


    public function store(Request $request)
    {
        
        $this->validate($request, 
        [
            'titulo' => ['required', 'max:40'],
            'descripcion' => ['required'],
            'imagen' => ['required'],
        ],
        [
            'required' => 'Este campo es requerido.',
            'max' => 'Maximo de :max carácteres permitidos.',
        ]);


        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('posts.index', ['user' => auth()->user()]);
    }
}
