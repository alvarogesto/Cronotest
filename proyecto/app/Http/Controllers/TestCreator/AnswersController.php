<?php

namespace App\Http\Controllers\TestCreator;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use Inertia\Inertia;

class AnswersController extends Controller {

    //Función para cargar la página
    public function create() {
        return Inertia::render('CreadorTest/CrearRespuesta');
    }

    //Función que valida los datos recibidos
    public function validateAnswer() {
        return request()->validate([
            'answer' => 'required',
            'correct' => 'required|boolean',
        ]);
    }

    public function store() {
        //Guardo el valor de testId en una variable
        $questionId = session('questionId');

        //Crea la nueva pregunta en la base de datos
        Answer::create(array_merge($this->validateAnswer(), [
            'question_id' => $questionId
        ]));

        //Al finalizar redirige al usuario a la página para elegir la siguiente acción
        return redirect('/test/crear/accion');
    }
}

