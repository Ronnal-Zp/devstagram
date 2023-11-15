@extends('layouts.app')

@section('titulo')
    .....
@endsection


@section('contenido')
    
    @if ($posts->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($posts as $post)
                <div>
                    <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                        <img src="{{ asset('uploads'). '/' .$post->imagen }}" alt="Post {{$post->titulo }}">
                    </a>
                </div>
            @endforeach
        </div>    

        <div class="mt-10">
            {{ $posts->links('pagination::tailwind') }}
        </div>
    @else
        <h1 class="text-gray-600 uppercase text-sm text-center font-bold">No haz creado ningun post</h1>
    @endif


@endsection
