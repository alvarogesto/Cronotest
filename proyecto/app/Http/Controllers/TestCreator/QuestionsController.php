<?php

namespace App\Http\Controllers\TestCreator;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Inertia\Inertia;
use Illuminate\Http\Request;

class QuestionsController extends Controller {

    //Función para cargar la página
    public function create() {
        return Inertia::render('CreadorTest/CrearPregunta');
    }

    //Función que valida los datos recibidos
    public function validateQuestion() {
        return request()->validate([
            'question' => 'required',
            'image' => 'nullable|file|image'
        ]);
    }

    public function store(Request $request) {
        //Guardo el valor de testId en una variable
        $testId = session('testId');

        // Validar todos los datos
        $data = $this->validateQuestion();
        
        // Guardar la ruta de la imagen si existe
        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/images/questionImages');
        }

        //Creo la pregunta
        $question = Question::create(array_merge($data, [
            'image' => $path,
            'test_id' => $testId
        ]));

        //Guardo el id de la pregunta en la sesión
        $questionId = $question->id;
        session(['questionId' => $questionId]);

        //Al finalizar redirige al usuario a la página para crear una respuesta
        return redirect('/test/crear/respuesta');
    }
}