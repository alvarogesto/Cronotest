<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginController extends Controller {
    
    //Función para cargar la página de Login cuando alguien no autentificado intenta entrar en una página donde es necesario estarlo
    public function create() {
        return Inertia::render('Usuario/Login');
    }

    //Función para iniciar sesión
    public function store(Request $request): RedirectResponse {
        //$credentials contiene los datos del formulario de login
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        //Si los datos validados son correctos se intenta autentificar al usuario
        if (Auth::attempt($credentials)) {
            //Si se autentifica al usuario se regenera la sesión
            $request->session()->regenerate();
            
            //Al acabar se redirige el usuario a la página de inicio
            return redirect()->intended('/');
        }
        
        //Si la autentificación falla se redirige a la página anterior y se muestra el mensaje de error en el campo email
        return back()->withErrors([
            'email' => 'Correo o contraseña inválidos',
        ])->onlyInput('email');
    }

    //Función para cerrar sesión
    public function destroy(Request $request): RedirectResponse {
        //Cerrar sesión
        Auth::logout();
        
        //Se invalida la sesión actual del usuario
        $request->session()->invalidate();
        
        //Se regenera el token de seguridad de la sesión
        $request->session()->regenerateToken();
        
        //Se redirige al usuario a la página de inicio
        return redirect('/');
    }
}
