<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(User $user){
        // Se recomienda usar attach para tablas pivote
        $user->followers()->attach(auth()->user()->id);
        return back();
    }

    public function destroy(User $user){
        // Se recomienda usar attach para tablas pivote
        $user->followers()->detach(auth()->user()->id);
        return back();
    }
}
