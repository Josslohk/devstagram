<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function store(Request $request){

        // dd($request->remember);
        
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Back es un "Vuelve a donde enviaste la informacion pero ahi va con un mensaje"
        if(!auth()->attempt($request->only('email','password'), $request->remember)){
            return back()->with('mensaje','Credenciales Incorrectas');
        };

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
