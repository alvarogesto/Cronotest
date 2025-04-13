<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Normalizer;

class UsersProfileController extends Controller {

    //Función para cargar la página
    public function show($username) {
        // Obtén el ID del usuario autenticado
        $usuarioAutenticadoId = auth()->id();
        
        // Guardo al usuario que ha creado el test (desde el que se ha accedido al perfil), buscandolo a partir de su username
        $usuario = User::where('username', $username)->first();

        // Guardo el usuario
        $usuarioAutenticado = User::find(auth()->id());

        // Esta variable guarda un booleano que indica si se puede editar el perfil o no
        $editar = false;

        // Si el creador del test es el mismo que el usuario se puede editar
        if ($usuarioAutenticadoId == $usuario->id) {
            $editar = true;
        }

        // Esta variable guarda un boolean que indica si se puede acceder al panel de admin o no
        $admin = false;

        // Si el creador del test es el mismo que el usuario autenticado, y este es un admin, se puede acceder al panel de admin
        if ($usuarioAutenticado->admin && $usuarioAutenticado->id == $usuario->id) {
            $admin = true;
        }

        /* En esta variable guardo los test que haya creado el usuario.
        Usando paginate devuelvo los test en grupos de 4. De esta forma al cargar la página no aparecen todos de golpe.*/
        $tests = Test::with('author', 'category', 'language', 'ratings')
            ->where('user_id', $usuario->id)
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        // Al devolver la página, se pasan las variables anteriores
        return Inertia::render('Perfil', ['usuario' => $usuario, 'tests' => $tests, 'estadoEditar' => $editar, 'admin' => $admin]);
    }

    //Función para cargar el perfil de usuario desde la barra de navegación
    public function showOwnProfile() {
        // Obtén el ID del usuario autenticado
        $userId = auth()->id();
        
        // Guardo el usuario
        $usuario = User::find(auth()->id());

        // Esta variable guarda un boolean que indica si se puede acceder al panel de admin o no
        $admin = false;

        // Si el usuario es un administrador se cambia el valor de admin a true
        if ($usuario->admin) {
            $admin = true;
        }

        /* En esta variable guardo los test que haya creado el usuario.
        Usando paginate devuelvo los test en grupos de 4. De esta forma al cargar la página no aparecen todos de golpe.*/
        $tests = Test::with('author', 'category', 'language', 'ratings')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        // Al devolver la página, se pasan las variables anteriores
        return Inertia::render('Perfil', ['usuario' => $usuario, 'tests' => $tests, 'estadoEditar' => true, 'admin' => $admin]);
    }

    public function create() {
        // Guardo el usuario autenticado
        $usuario = User::find(auth()->id());

        // Al devolver la página, se pasa la variable anterior
        return Inertia::render('EditarPerfil', ['usuario' => $usuario]);
    }

    public function store(Request $request) {

        $attributes = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'description' => 'nullable',
            'email' => ['required', 'email'],
        ]);

        // Normalizar el nombre para evitar errores con tildes
        $attributes['name'] = Normalizer::normalize($attributes['name']);
        
        // Eliminar el campo password del array de atributos
        unset($attributes['password']);

        // Obtener el usuario actual desde la base de datos
        $usuario = User::find(auth()->id());

        // Actualizar los datos del usuario
        $usuario->update($attributes);

        // Al devolver la página, se pasan las variables anteriores
        return Inertia::render('Inicio');
    }

    public function storeAvatar(Request $request) {

        $attributes = $request->validate([
            'avatar' => 'nullable|file|image'
        ]);
        
        // Guardar la ruta del avatar si existe
        $path = null;
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('public/images/avatar');
            
            $attributes['avatar'] = $path;
        }

        // Obtener el usuario actual desde la base de datos
        $usuario = User::find(auth()->id());

        // Actualizar los datos del usuario
        $usuario->update($attributes);
    }
}