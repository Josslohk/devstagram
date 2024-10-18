@extends('layouts.app')

@section('titulo')
    Pagina principal
@endsection('')

@section('contenido')

    {{-- Pasar la variable del controlador al componente --}}
    <x-listar-post :posts="$posts"/>

    {{-- Es como un if pero con un forEach --}}
    {{-- @forelse ($posts as $post)
        <h1>{{ $post->titulo }}</h1>
    @empty
        <p>noHay</p>
    @endforelse --}}
@endsection('')