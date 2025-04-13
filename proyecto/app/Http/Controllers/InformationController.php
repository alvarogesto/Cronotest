<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Models\Test;
use App\Models\User;

class InformationController extends Controller {

    //Función para cargar la página
    public function show($id) {

        // Obtener el test según en el ID junto con las otras tablas relacionadas
        $test = Test::with('author', 'category', 'language', 'ratings',  'results')->find($id);

        // Guardar el id del usuario autentificado
        $usuarioId = auth()->id();
        
        // Guardo el usuario
        $usuarioAutenticado = User::find($usuarioId);   
        
        // Crear una variable que guarda true o false dependiendo de si se es admin o no
        /* Es necesario crear esta variable porque los test los pueden realizar usuarios sin rigistrar
        y estos al hacer $usuarioAutenticado->admin daría null en vez de true o false */
        $esAdmin = false;

        // Si existe un usuario registrado se le asigna su valor del campo admin a esAdmin
        if ($usuarioAutenticado != null) {
            $esAdmin = $usuarioAutenticado->admin;
        }

        // Esta variabla va a determinar si aparece en la pestaña de información detalla el botón de borrar test
        $permitirBorrar = false;

        // Si el usuario auntentificado es el mismo que el creador del test o es un administrador permitirBorrar pasa a true
        if ($usuarioId == $test->author->id || $esAdmin) {
            $permitirBorrar = true;    
        }
    
        //Al devolver la página, se pasan también el test
        return Inertia::render('InformacionDetallada', ['test' => $test, 'usuario' => $usuarioId, 'permitirBorrar' => $permitirBorrar]);

    }

}