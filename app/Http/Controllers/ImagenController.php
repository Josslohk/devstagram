<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
class ImagenController extends Controller
{
    public function store(Request $request){
        // $manager = new ImageManager(new Driver());
        // $imagen = $request->file('file');
        // // Generar ID unico para cada una de las imagenes
        // $nombreImagen = Str::uuid() . "." . $imagen->extension();
        // // Clase de intervention image
        // $imagenServidor = $manager->read($imagen);
        // $imagenServidor->resize(1000,1000);
        
        // $imagenPath = public_path('uploads') . '/' . $nombreImagen;
        // $imagenServidor->save($imagenPath);
        // return response()->json(['imagen' => $nombreImagen]);

        $request->validate([
            'file' => 'required|image',
        ]);
    
        $image = $request->file('file');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads'), $imageName);
    
        return response()->json(['imagen' => $imageName]);
    }
}
