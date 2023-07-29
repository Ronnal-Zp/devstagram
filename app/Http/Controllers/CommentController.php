<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function store(Request $request, Post $post)
    {
        $this->validate($request,
            [
                'comentario' => ['required', 'max:255']
            ],
            [
                'required' => 'Este campo es requerido.',
                'max' => 'Maximo de :max caracteres permitidos.'
            ]
        );


        Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comentario' => $request->comentario
        ]);

        return back()->with('mensaje', '¡Comentario agregado!');
    }
}
