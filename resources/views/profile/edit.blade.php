@extends('layouts.app')


@section('titulo')
    Editar
@endsection


@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form action="{{ route('profile.store', $user) }}" class="mt-10 md:mt-0" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>

                    <input
                        id="username"
                        name="username"
                        type="text"
                        class="border p-3 w-full rounded-lg @error('username')
                            border-red-500
                        @enderror"
                        value="{{ auth()->user()->username }}"
                    >
                    @error('username')
                        <p class="bg-red-500 text-white my-1 rounded-lg text-sm p-1 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-10">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                        Subir imagen
                    </label>

                    <input
                        id="imagen"
                        name="imagen"
                        type="file"
                        accept=".jpg, .jpeg, .png"
                        class="border p-3 w-full rounded-lg"
                    >
                </div>


                <hr>
                <div class="mb-5 mt-10">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Contraseña actual
                    </label>

                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="border p-3 w-full rounded-lg @error('password')
                            border-red-500
                        @enderror"
                        value=""
                    >
                    @error('password')
                        <p class="bg-red-500 text-white my-1 rounded-lg text-sm p-1 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="new_password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nueva contraseña
                    </label>

                    <input
                        id="new_password"
                        name="new_password"
                        type="password"
                        class="border p-3 w-full rounded-lg @error('new_password')
                            border-red-500
                        @enderror"
                        value=""
                    >
                    @error('new_password')
                    @if ($message != 'Las contraseñas no coinciden')
                        <p class="bg-red-500 text-white my-1 rounded-lg text-sm p-1 text-center">{{ $message }}</p>
                    @endif
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="new_password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                        Confirmar nueva contraseña
                    </label>

                    <input
                        id="new_password_confirmation"
                        name="new_password_confirmation"
                        type="password"
                        class="border p-3 w-full rounded-lg @error('new_password_confirmation')
                            border-red-500
                        @enderror"
                        value=""
                    >
                    @error('new_password')
                        @if ($message == 'Las contraseñas no coinciden')
                            <p class="bg-red-500 text-white my-1 rounded-lg text-sm p-1 text-center">{{ $message }}</p>
                        @endif
                    @enderror

                    <input type="submit" value="Actualizar" class="bg-sky-600 hover:bg-sky-700 uppercase font-bold w-full mt-2 p-3 text-white rounded-lg cursor-pointer">
                </div>
            </form>
        </div>
    </div>
@endsection