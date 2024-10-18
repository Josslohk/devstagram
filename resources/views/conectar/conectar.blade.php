@extends('layouts.app')

@section('titulo')
    Conecta con más usuarios
@endsection

@section('contenido')
    <div>
        <div class="mb-5 mx-6 mt-10 grid md:grid-cols-2 gap-4">
            @if ($users->count())
                @foreach ($users as $user)
                    <a href="{{ route('posts.index', $user) }}">
                        <div class="bg-white shadow flex justify-start p-5 border-gray-300 border-b">
                            <div class="w-1/12 mt-1 mr-2">
                                <img src="{{ $user->imagen ? asset('perfiles' . '/' . $user->imagen) : asset('img/usuario.svg') }}"
                                    alt="Imagen Usuario">
                            </div>
                            <div class="mt-1 mr-2">
                                <p class="text-md font-bold">{{ $user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $user->username }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            @else
                <p class="p-10 text-center">No Hay Usuarios Registrados</p>
            @endif
        </div>
    </div>
@endsection
