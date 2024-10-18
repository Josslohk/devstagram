<div>
    @if($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($posts as $post)
                <div class="relative group transition ease-in-out hover:scale-110">
                    <a href="{{ route('posts.show', ['post' => $post,'user' => $post->user]) }}">
                        <img src="{{ asset('uploads') . "/" . $post->imagen }}" alt="Imagen del Post {{ $post->titulo }}">
                    </a>
                    <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-70 text-white flex justify-start items-center text-lg opacity-0 transition-opacity duration-300 ease-in-out group-hover:opacity-100">
                        <div class="flex flex-col ps-2 pt-1 pb-1">
                            <p class="text-xs">{{ $post->user->name }}</p>
                            <p class="text-xs">{{ $post->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="my-10">
            {{$posts->links('pagination::tailwind')}}
        </div>
        @else
        <p class="text-center">No Hay Posts, sigue a alguien para poder mostrar sus posts</p>
    @endif
</div>