<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ConectarController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index(){ 
        $users = User::all();
        return view('conectar.conectar',[
            'users' => $users
        ]);
    }
}
