@extends('layouts.app')

@section('titulo')
Página principal
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
    <div class="flex justify-center">
        <a class="w-3/12 " href="{{ route('conectar') }}">
        <div class="flex justify-center bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold p-3 text-white rounded-lg">
                <p class="font-bold uppercase text-sm">Conecta con más usuarios</p>
            </div>
        </a>
    </div>
@endsection('')