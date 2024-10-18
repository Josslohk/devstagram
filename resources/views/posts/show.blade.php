@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}" srcset="">
            <div class="p-3 flex items-center gap-4">
                @auth

                {{-- @php
                    $mensaje = "Hola mundo desde una variable";
                @endphp
                <livewire:like-post :mensaje="$mensaje"/> --}}
                <livewire:like-post :post="$post"/>

                {{-- @livewire('like-post') --}}
                {{-- <livewire:like-post /> --}}
                {{-- <livewire:like-post></livewire:like-post> --}}
                @endauth
                
            </div>
            <div class="shadow bg-white p-5 mb-5">
                <a href="{{ route('posts.index', $post->user) }}">
                    <p class="font-bold">{{ $post->user->username }}</p>
                </a>
                <p class="text-sm text-gray-500">
                    {{ $post->created_at->diffForHumans() }}
                </p>
                <p class="mt-5">
                    {{ $post->descripcion }}
                </p>
            </div>
            @auth
                @if ($post->user_id === auth()->user()->id)
                    <form method="POST" action="{{ route('posts.destroy', $post) }}">
                        {{-- Metodo spoofing --}}
                        @method('DELETE')
                        @csrf
                        <input type="submit" value="Eliminar Publicacion"
                            class="bg-red-500 hover:bg-red-600 p-2 text-white rounded font-bold mt-4 cursor-pointer" />
                    </form>
                @endif
            @endauth
        </div>
        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">
                @auth
                    <livewire:comment-post :post="$post"/>
                @endauth
                <livewire:comentarios :post="$post"/>
                {{-- <div class="bg-white shadow mb-5 max-h-96 overflow-y-auto mt-10">
                    @if ($post->comentarios->count())
                        @foreach ($post->comentarios as $comentario)
                            <div class="shadow flex justify-start p-5 border-gray-300 border-b">
                                <div class="w-1/12 mt-1 mr-2">
                                    <a href="{{ route('posts.index', $comentario->user) }}">
                                        <img src="{{ $user->imagen ? asset('perfiles' . '/' . $comentario->user->imagen) : asset('img/usuario.svg') }}"
                                            alt="Imagen Usuario">
                                    </a>
                                </div>
                                <div>
                                    <a href="{{ route('posts.index', $comentario->user) }}" class="font-bold">
                                        {{ $comentario->user->username }}
                                    </a>
                                    <p>{{ $comentario->comentario }}</p>
                                    <p class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">No Hay Comentarios Aún</p>
                    @endif
                </div> --}}

            </div>
        </div>
    </div>
@endsection
