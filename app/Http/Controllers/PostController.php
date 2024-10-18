<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index', 'mostrarUsuarios']);
    }

    public function index(User $user){
        // Mostrar datos del usuario
        // dd(auth()->user());
        $posts = Post::where('user_id', $user->id)->latest()->paginate(12);
        // dd($user->username);
        return view('layouts.dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }
    
    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        // Post::create([
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,
        //     'user_id' => auth()->id()
        // ]);

        // ---------- Otra Forma de registro
        // $post = new Post;
        // $post->titulo = $request->titulo;
        // $post->descripcion = $request->descripcion;
        // $post->imagen = $request->imagen;
        // $post->user_id = auth()->id();
        // $post->save();

        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->id()
        ]);
            
        

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post){
        return view('posts.show', [
            'user' => $user,
            'post' => $post
        ]);
    }
    public function mostrarUsuarios(User $user, Post $post){
        $user = User::all();
        return response()->json($user);
    }

    public function destroy(Post $post){
        $this->authorize('delete', $post);
        $post->delete();

        // Eliminar la Imagen
        $imagen_path = public_path('uploads/' . $post->imagen);
        if (File::exists($imagen_path)) {
            unlink($imagen_path);
        }
        return redirect()->route('posts.index',auth()->user()->username);
    }
}
