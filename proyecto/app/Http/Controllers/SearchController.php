<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Category;
use App\Models\Language;
use Inertia\Inertia;
use Illuminate\Http\Request;

class SearchController extends Controller {

    // Función para cargar la página
    public function index(Request $request) {
        /* En esta variable guardo el contenido de los test junto con el usuario que lo haya creado, el idioma 
        y la categoría a la que pertenece. Para ello tengo que usar una relación para obtener sus datos. 
        Recojo los test en orden descendente para que así aparezcan por defecto los más nuevos primero.
        Luego usando paginate devuelvo los test en grupos de 24. De esta forma al cargar la página no aparecen todos de golpe.*/
        $tests = Test::with('author', 'category', 'language')
                    //Aquí se aplica el filtro del modelo Test
                    ->filter($request->only(['buscar', 'category', 'language']))
                    ->orderBy('created_at', 'desc')
                    ->paginate(24);
       
        // En esta variable guardo todas las categorías de la tabla categories
        $categories = Category::all();

        // En esta variable guardo todos los lenguajes de la tabla lenguages
        $languages = Language::all();
        
        // Al devolver la página, se pasan las variables anteriores
        return Inertia::render('Buscador', [
            'tests' => $tests,
            'categories' => $categories,
            'languages' => $languages,
            'filters' => $request->only(['buscar', 'category', 'language'])
        ]);
    }
}