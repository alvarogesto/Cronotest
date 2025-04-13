<?php

namespace App\Http\Controllers\TestCreator;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ActionsController extends Controller {

    //Función para cargar la página
    public function create() {
        return Inertia::render('CreadorTest/SiguienteAccion');
    }

    public function redirect(Request $request) {

        //Obtiene el valor de accion
        $action = $request->input('accion');

        //Redirige al usuario a una página u otra según el botón que se haya pulsado
        switch ($action) {
            case 'addAnswer':
                return redirect('/test/crear/respuesta');
            case 'addQuestion':
                return redirect('/test/crear/pregunta');
            case 'finishTest':
                return redirect('/');
            default:
                return redirect('/');
        }
    }
}
