@extends('layouts.app')

@section('titulo')
    Crear una nueva Publicacion
@endsection

@push('styles')
    {{-- @vite(['resources/css/dropzone_styles.css']) --}}
    {{-- @vite(['public/css/dropzone_styles.css']) --}}
    <link rel="stylesheet" href="{{ asset('css/dropzone_styles.css') }}">
@endpush

@section('contenido')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            <form id="dropzone" enctype="multipart/form-data" action="{{ route('image.store') }}" method="post" class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
                @csrf
            </form>
        </div>

        <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0">
            <form action="{{ route('posts.store') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">
                        Titulo de la Publicacion
                    </label>
                    <input
                        id="titulo"
                        name="titulo"
                        type="text"
                        class="border p-3 w-full rounded-lg @error('titulo')
                            border-red-500
                        @enderror"
                        value="{{ old('titulo') }}"
                    >
                    @error('titulo')
                        <p class="bg-red-500 text-white my-1 rounded-lg text-sm p-1 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">
                        Descripcion de la Publicacion
                    </label>
                    <textarea
                        id="descripcion"
                        name="descripcion"
                        type="text"
                        placeholder="Descripcion de la Publicacion"
                        class="border p-3 w-full rounded-lg @error('descripcion')
                            border-red-500
                        @enderror"
                    > {{ old('descripcion') }} </textarea>

                    @error('descripcion')
                        <p class="bg-red-500 text-white my-1 rounded-lg text-sm p-1 text-center">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nombre de la imagen que se genera al subir --}}
                <input type="hidden" name="imagen" value="{{ old('imagen') }}">

                <input type="submit" value="Crear" class="bg-sky-600 hover:bg-sky-700 uppercase font-bold w-full p-3 text-white rounded-lg cursor-pointer">
            </form>
        </div>
    </div>
@endsection
