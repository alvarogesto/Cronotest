<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Str;

class AdminController extends Controller {
    
    //Función para cargar la página
    public function create() {
        return Inertia::render('PanelAdmin');
    }


    public function storeCategory(Request $request) {
        
        // Guardo el usuario autenticado
        $usuario = User::find(auth()->id());  

        //Obtiene el valor de category
        $category = $request->input('category');

        // Genero un slug para la categoría
        $categorySlug = Str::slug($category);

        // Si el usuario es un administrador creo la categoría
        if ($usuario->admin) {
            
            Category::create([
                'name' => $category,
                'slug' => $categorySlug,
            ]);
        }
    }

    public function storeLanguage(Request $request) {

        // Guardo el usuario autenticado
        $usuario = User::find(auth()->id());   

        //Obtiene el valor de idioma
        $language = $request->input('language');

        // Genero un slug para el idioma
        $languageSlug = Str::slug($language);

        // Si el usuario es un administrador creo el idioma
        if ($usuario->admin) {
            Language::create([
                'name' => $language,
                'slug' => $languageSlug,
            ]);
        }
    }
}
