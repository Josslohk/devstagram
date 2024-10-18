<div>
    <p class="text-xl font-bold text-center mb-4">Agrega un nuevo Comentario</p>

    @if (session()->has('message'))
        <div class="bg-green-500 p-2 rounded-lg mb-6 text-center text-white uppercase font-bold">
            {{ session('message') }}
        </div>
    @endif

    {{-- <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user]) }}" method="POST">
        @csrf
        
    </form> --}}
    <div class="mb-5">
        <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">Añade un
            Comentario</label>
        <textarea id="comentario" name="comentario" wire:model="comentario" placeholder="Agrega un Comentario"
            class="border p-3 w-full rounded-lg 
                        @error('descripcion')
                            border-red-500
                        @enderror"></textarea>
        @error('comentario')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center font-bold">
                {{ $message }}</p>
        @enderror
    </div>
    <button wire:click="Comentar" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
        Comentar
    </button>
</div>
