<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }


    public function index(User $user)
    {
        $posts = Post::where('user_id', $user->id)->paginate(4);

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }


    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user
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


    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        $image_path = public_path('uploads/' . $post->imagen);
        if(File::exists($image_path)) {
            unlink($image_path);
        }

        return redirect()->route('posts.index', auth()->user());
    }
}
