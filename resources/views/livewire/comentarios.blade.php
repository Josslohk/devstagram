<div>
    <div class="bg-white shadow mb-5 max-h-96 overflow-y-auto mt-10">
        @if ($comentarios->count())
            @foreach ($comentarios as $comentario)
                <div class="shadow flex justify-start p-5 border-gray-300 border-b">
                    <div class="w-1/12 mt-1 mr-2">
                        <a href="{{ route('posts.index', $comentario->user) }}">
                            <img src="{{ $comentario->user->imagen ? asset('perfiles' . '/' . $comentario->user->imagen) : asset('img/usuario.svg') }}"
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
    </div>
</div>
