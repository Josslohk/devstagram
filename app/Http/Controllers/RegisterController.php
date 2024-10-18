<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index() 
    {
        return view('auth.register');
    }
    public function store(Request $request){
        // dd($request);
        // dd($request->get('name'));

        $request->request->add(['username' => Str::slug($request->username)]);
        // Validacion
        $this->validate($request, [
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6'

            // Sintaxis de Arreglo
            // 'name' => ['required','min:5'],
            // Sintaxis General
            // 'name' => 'required|max:30',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            // Laravel 10 y 11 ya hashan los passwords de manera automatica
            // 'password' => $request->password

            // Laravel anteriores son con la libreria hash:
            'password' => Hash::make($request->password)
        ]);
        // dd('Creando Usuario');


        // Autenticar Usuario
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password,
        // ]);

        // Otra forma de Autenticar al usuario
        auth()->attempt($request->only('email','password'));

        // Redireccionar
        return redirect()->route('posts.index', auth()->user()->username);
    }

}
