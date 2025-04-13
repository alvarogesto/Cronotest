<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RatingResumeController extends Controller {
    public function show() {
        // Recuperar datos de la sesión
        $preguntas = session('preguntas', []);
        $puntuacion = session('puntuacion', []);
        $testId = session('testId', []);
        $testSlug = session('testSlug', []);

        // Guardar el usuario
        $usuario = auth()->id();
        
        // Devolver la página con las variables necesarias
        return Inertia::render('ValoracionResumen', ['preguntas' => $preguntas, 'puntuacion' => $puntuacion, 'usuario' => $usuario, 'testId' => $testId, 'testSlug' => $testSlug]);
    }

    public function resume(Request $request) {
        // Obtener los datos necesarios para cargar la página
        $preguntas = $request->input('preguntas');
        $testId = $request->input('testId');
        $testSlug = $request->input('testSlug');
        $puntuacion = $request->input('puntuacion');

        // Almacenar las preguntas en la sesión
        session(['preguntas' => $preguntas]);
        session(['puntuacion' => $puntuacion]);
        session(['testId' => $testId]);
        session(['testSlug' => $testSlug]);

        // Redirigir a la página de resumen y valoración
        return redirect('/realizar-test/' . $testId . '/' . $testSlug . '/resumen');
    }

    public function rating(Request $request) {

        $usuario = auth()->id();
        $testId = session('testId', []);
        $like = $request->input('like');
        $difficulty = $request->input('difficulty');
        $originality = $request->input('originality');

        // Si existe el usuario, guarda los datos en la base de datos
        if (isset($usuario)) {
            // Crear o actualizar un registro en la tabla ratings para el usuario y el test específicos
            Rating::updateOrCreate(
                ['user_id' => $usuario, 'test_id' => $testId],
                ['like' => $like, 'difficulty' => $difficulty, 'originality' => $originality]
            );
        }

    }
}
