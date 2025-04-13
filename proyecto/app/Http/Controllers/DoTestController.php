<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\TestResult;
use Inertia\Inertia;
use Illuminate\Http\Request;

class DoTestController extends Controller {

    // Función para cargar la página
    public function show($id) {
        // Obtener el test según en el ID y pasarle las preguntas y respuestas
        $test = Test::with('question', 'answer')->find($id);

        // Al devolver la página, se pasan también el test
        return Inertia::render('RealizarTest', ['test' => $test]);
    }

    public function store(Request $request) {
        // Obtiener la puntuación, el id del test y el usuario
        $puntuacion = $request->input('puntuacion');
        $preguntasCorrectas = $request->input('preguntasCorrectas');
        $idTest = $request->input('id');
        $usuario = auth()->id();

        // Si existe el usuario, guarda los datos en la base de datos
        if (isset($usuario)) {
            // Crear o actualizar un registro en la tabla test_results para el usuario y el test específicos
            TestResult::updateOrCreate(
                ['user_id' => $usuario, 'test_id' => $idTest],
                ['right_questions' => $preguntasCorrectas, 'score' => $puntuacion]
            );
        }
    }

    // Función para cargar la página sin puntuación ni tiempo
    public function showCasual($id) {
        // Obtener el test según en el ID y pasarle las preguntas y respuestas
        $test = Test::with('question', 'answer')->find($id);

        // Al devolver la página, se pasan también el test
        return Inertia::render('RealizarTestCasual', ['test' => $test]);
    }
}
