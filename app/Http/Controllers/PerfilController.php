<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PerfilController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index(){
        return view('perfil.index');
    }

    public function store(Request $request){

        $request->request->add(['username' => Str::slug($request->username)]);
        $this->validate($request, [
            'username' => ['required','unique:users,username,'.auth()->user()->id,'min:3','max:20','not_in:editar-perfil']
        ]);
        $this->validate($request, [
            'name' => ['required','min:3','max:80']
        ]);
        $usuario = User::find(auth()->user()->id);
        // $usuario->update($request->all());
        $usuario->username = $request->username;
        $usuario->name = $request->name;
        $usuario->imagen = $request->imagen ?? auth()->user()->imagen ?? '';
        $usuario->save();

        return redirect()->route('posts.index', $usuario->username);
    }
    public function storeImage (Request $request){
        $request->validate([
            'file' => 'required|image',
        ]);
    
        $image = $request->file('file');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('perfiles'), $imageName);
    
        return response()->json(['imagen' => $imageName]);
    }
}
