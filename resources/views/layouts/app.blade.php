<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Devstagram @yield('titulo')</title>

        <!-- Fonts -->
        <!-- <link rel="preconnect" href="https://fonts.bunny.net"> -->
        <!-- <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" /> -->

        @stack('styles') 
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/app.js') }}"></script> --}}
    </head>
    <body class="bg-gray-100">

        <header class="p-5 border-b bg-white shadow">
            <div class="container mx-auto flex justify-between items-center">
                <a href="{{ route('home') }}"> <h1 class="text-3xl font-black">Devstagram</h1> </a>

                @auth
                    <a class="font-bold text-xl px-5 py-2 rounded-md bg-blue-950 text-white cursor-pointer" href="{{ route('posts.index', auth()->user()) }}">{{ auth()->user()->name }}</a>

                    <nav class="flex gap-2 items-center leading-3">
                        <a class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer" href="{{ route('posts.create') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                            </svg>
                            CREAR
                        </a>

                        {{-- <a class="text-sm text-slate-700 font-bold">
                            {{ $user->name }}
                        </a> --}}

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="border-slate-700 text-slate-700 text-xl">Cerrar sesion</button>
                        </form>
                    </nav>
                @else
                    <nav class="flex gap-2 items-center">
                        <a href="{{ route('login') }}" class="font-bold uppercase text-gray-600 text-sm cursor-pointer">Login</a>
                        <a href="{{ route('register') }}" class="font-bold uppercase text-gray-600 text-sm cursor-pointer">Register</a>
                    </nav>
                @endauth
            </div>
        </header>

        <main class="container mx-auto mt-10">
            <h2 class="font-black text-center text-3xl mb-10">
                @yield('titulo')
            </h2>

            @yield('contenido')
        </main>

        <footer class="text-center p-5 mt-10 text-gray-500 font-bold uppercase">
            DevStagram - Todos los derechos reservados {{ now()->year }}
        </footer>
        @livewireScripts
    </body>
</html>
