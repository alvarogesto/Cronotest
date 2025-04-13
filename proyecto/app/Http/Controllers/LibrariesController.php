<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller; 
use Inertia\Inertia;
use App\Models\Test;
use App\Models\Library;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LibrariesController extends Controller {

    public function index(Request $request) {

        // Obtener el usuario
        $usuario = auth()->id();

        // Obtén los IDs de los tests guardados por el usuario en la librería
        $testIds = Library::where('user_id', $usuario)->pluck('test_id')->toArray();

        // Obtén los tests asociados a esos IDs. Tras eso, uso paginate para devolverlos en grupos de 24
        $tests = Test::with('author', 'category', 'language')
            ->whereIn('id', $testIds)
            ->filter($request->only(['buscar', 'category', 'language']))
            ->orderBy('created_at', 'desc')
            ->paginate(24);

        return Inertia::render('Biblioteca', ['tests' => $tests]);
    }

    //Función para guardar un test en la biblioteca
    public function store(Request $request) {
       
        // Obtener el usuario
        $usuario = auth()->id();

        //Obtener el id del test
        $id = $request->input('id');

        // Guardar el test en la biblioteca
        DB::table('libraries')->upsert([
            // Datos que se insertarán o actualizarán
            'user_id' => $usuario,
            'test_id' => $id,
        ], [
            // Columnas utilizadas para buscar el registro existente
            'user_id',
            'test_id',
        ]);
    }    

    //Función para eliminar un test de la biblioteca
    public function destroy(Request $request) {
    
        // Obtener el usuario
        $usuario = auth()->id();

        //Obtener el id del test
        $id = $request->input('id');

        // Eliminar la relación del test en la biblioteca del usuario
        DB::table('libraries')->where('user_id', $usuario)->where('test_id', $id)->delete();

    }   

}