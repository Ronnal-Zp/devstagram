@extends('layouts.app')

@section('titulo')
    .....
@endsection


@section('contenido')
    
    @if ($posts->count() > 0)
        <x-list-posts :posts="$posts"/>
    @else
        <p class="text-gray-600 uppercase text-sm text-center font-bold">No sigues ningun usuario con posts</p>
    @endif

@endsection
