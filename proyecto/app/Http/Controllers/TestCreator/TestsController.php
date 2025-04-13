<?php

namespace App\Http\Controllers\TestCreator;

use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\Category;
use App\Models\Library;
use App\Models\Rating;
use App\Models\Language;
use App\Models\TestResult;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TestsController extends Controller
{

    //Función para cargar la página
    public function create()
    {
        //Variable que guarda todas las categorías
        $categories = Category::all();

        //Variable que guarda todas los lenguajes
        $languages = Language::all();

        //Al devolver la página, se pasan también las categorías
        return Inertia::render('CreadorTest/CrearTest', ['categories' => $categories, 'languages' => $languages]);
    }

    //Función que valida los datos recibidos
    public function validateTest()
    {
        return request()->validate([
            'title' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|file|image'
        ]);
    }

    public function store(Request $request) {

        // Obtener el valor de category, language y title
        $category = $request->input('category');
        $language = $request->input('language');
        $title = $request->input('title');

        // Genera el slug a partir del título
        $slug = Str::slug($title);

        // Validar todos los datos
        $data = $this->validateTest();

        // Guardar la ruta de la imagen si existe
        $path = null;
        if ($request->hasFile('image')) {
            $path =$request->file('image')->store('public/images/thumbnails');
        }

        // Crear el test asignando el valor de los campos que lo necesitan
        $test = Test::create(array_merge($data, [
            'image' => $path,
            'slug' => $slug,
            'user_id' => auth()->id(),
            'category_id' => $category,
            'language_id' => $language,
        ]));

        //Guardar el id del test en la sesión
        $testId = $test->id;
        session(['testId' => $testId]);

        //Al finalizar redirige al usuario a la página para crear una pregunta
        return redirect('/test/crear/pregunta');
    }

    public function delete($testId, $userId) {
        
        // Guardar el id del usuario autenticado
        $usuarioId = auth()->id();

        // Guardo el usuario auntenticado
        $usuarioAuntenticado = User::find($usuarioId);     

        // Si el id del usuario que se manda desde el Front-end coincide con el usuario autenticado o es un administrador, se borra el test
        if ($userId == $usuarioId || $usuarioAuntenticado->admin  == true) {

            // Guardo el test con las preguntas y las respuestas
            $test = Test::with('question', 'answer')->find($testId);

            // Para evitar que de errores al eliminar con llaves foráneas:

            // Borro todas las respuestas asociadas a las preguntas del test
            foreach ($test->question as $question) {
                $question->answer()->delete();
            }

            // Borro todos los resultados asociados al test
            $testResultados = TestResult::where('test_id', $testId)->get();
            
            foreach ($testResultados as $resultado) {
                $resultado->delete();
            }

            // Borro el test de todas las bibliotecas
            $testBiblioteca = Library::where('test_id', $testId)->get();
            
            foreach ($testBiblioteca as $biblioteca) {
                $biblioteca->delete();
            }

            // Borro todas las valoraciones que tenga el test
            $testValoraciones = Rating::where('test_id', $testId)->get();
            
            foreach ($testValoraciones as $valoracion) {
                $valoracion->delete();
            }

            // Finalmente borro el test
            $test->delete();

            // Redirijo a inicio
            return redirect('/');
        }
    }
}
