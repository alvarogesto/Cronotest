<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;

class UsersController extends Controller {

    public function create()
    {
        return Inertia::render('Usuario/Registro');
    }
   
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => ['required', 'email'],
            'password' => 'required',
            'admin' => 'nullable'
        ]);
    
        // Crea el nuevo test en la base de datos
        User::create($attributes);
    
        return redirect('/');
    }
}

