<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    // Solo cuando se tiene un metodo en un controlador se usa invoke
    public function __invoke()
    {
        // Obtener a quienes seguimos
        // Pluck extrae solamente ciertos campos
        $ids = auth()->user()->followings->pluck('id')->toarray();
        // Where filtra un valor, where in filtra un arreglo
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);

        return view('home',[
            'posts' => $posts
        ]);
    }
}
