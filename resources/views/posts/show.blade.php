@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    @if( session('mensaje') )
        <p class="text-center text-gray-800 drop-shadow-lg text-xl mb-3">{{ session('mensaje') }}</p>
    @endif

    <div class="container mx-auto md:flex">
        <div class="md:w-1/2 p-5">
            <img class="rounded" src="{{ asset('uploads' . '/' . $post->imagen) }}" alt="Imagen del post {{ $post->titulo }}">

            <div class="p-3 flex items-center">
                @auth

                    <livewire:like-post :$post />
                    
                @else
                    <button class="mx-1" type="button" class="cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                        </svg>                              
                    </button>
                @endauth    
            </div>

            <div class="px-3">
                <a href="{{ route('posts.index', $user) }}" class="font-bold">{{ $post->user->username }}</a>
                <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                <p class="mt-5">{{ $post->descripcion }}</p>
            </div>

            @auth
                @if( auth()->user()->id == $user->id)
                    <div class="px-3 mt-8">
                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input class="bg-red-700 px-4 py-2 text-white cursor-pointer rounded-md" type="submit" value="Eliminar publicacion">
                        </form>
                    </div>    
                @endif
            @endauth
        </div>


        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">

                @auth()
                    <p class="text-xl font-bold text-center mb-4">Comenta esta publicacion</p>
                    <form action="{{ route('comments.store', ['post' => $post]) }}" method="POST">
                        @csrf
                        <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                            Comentar
                        </label>
                        <textarea
                            id="comentario"
                            name="comentario"
                            type="text"
                            class="border p-3 w-full rounded-lg @error('comentario')
                                border-red-500
                            @enderror"
                            required
                        > </textarea>
    
                        @error('comentario')
                            <p class="bg-red-500 text-white my-1 rounded-lg text-sm p-1 text-center">{{ $message }}</p>
                        @enderror

                        <input type="submit" value="Comentar" class="bg-sky-600 hover:bg-sky-700 uppercase font-bold w-full p-3 text-white rounded-lg cursor-pointer">
                    </form>
                @endauth

                <div class="bg-white shadow mt-5 max-h-96 overflow-y-scroll">
                    @if ($post->comments->count() > 0)
                        @foreach ( $post->comments as $comment )
                            <div class="p-5 border-gray-300 border-b">
                                <a class="font-bold"href="{{ route('posts.index', $comment->user) }}">{{ $comment->user->username }}</a>
                                <p>{{ $comment->comentario }}</p>
                                <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">Aun no hay comentarios</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection