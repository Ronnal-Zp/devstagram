@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    @if( session('mensaje') )
        <p class="text-center text-gray-800 drop-shadow-lg text-xl mb-3">{{ session('mensaje') }}</p>
    @endif

    <div class="container md:w-274 mx-auto md:flex">
        <div class="md:w-1/2 p-5">
            <img class="rounded" src="{{ asset('uploads' . '/' . $post->imagen) }}" alt="Imagen del post {{ $post->titulo }}">

            
            @auth

                <livewire:like-post :$post />
                
            @else
                <div class="py-2 px-1 flex items-center">
                    <button class="mx-1" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                        </svg>                              
                    </button>

                    <p class="leading-3">{{ $post->likes()->count() }} Likes</p>
                </div>
            @endauth    
            

            <div class="w-full flex justify-between">
                <div class="px-3">
                    <a href="{{ route('posts.index', $user) }}" class="font-bold leading-none">{{ $post->user->username }}</a>
                    <p class="text-sm text-gray-500 leading-none">{{ $post->created_at->diffForHumans() }}</p>
                    <p class="mt-5">{{ $post->descripcion }}</p>
                </div>
    
                @auth
                    @if( auth()->user()->id == $user->id)
                        <div class="px-3">
                            <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input class="bg-red-700 px-4 py-2 text-white cursor-pointer rounded-md" type="submit" value="Eliminar publicacion">
                            </form>
                        </div>    
                    @endif
                @endauth
            </div>
        </div>


        <div class="md:w-1/2 p-5">
            <livewire:create-comment :$post>
        </div>
    </div>

@endsection