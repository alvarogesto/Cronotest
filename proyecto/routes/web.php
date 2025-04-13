<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TestCreator\TestsController;
use App\Http\Controllers\TestCreator\QuestionsController;
use App\Http\Controllers\TestCreator\AnswersController;
use App\Http\Controllers\TestCreator\ActionsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\DoTestController;
use App\Http\Controllers\RatingResumeController;
use App\Http\Controllers\LibrariesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\UsersProfileController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return inertia('Inicio');
});

Route::get('/buscador', [SearchController::class, 'index']);

Route::get('/informacion-detallada/{id}/{slug}', [InformationController::class, 'show']);

Route::get('/realizar-test/{id}/{slug}', [DoTestController::class, 'show']);
Route::post('/realizar-test/guardar-datos', [DoTestController::class, 'store']);

Route::get('/realizar-test/casual/{id}/{slug}', [DoTestController::class, 'showCasual']);

Route::match(['get'], '/realizar-test/{id}/{slug}/resumen', [RatingResumeController::class, 'show']);
Route::match(['post'], '/realizar-test/{id}/{slug}/resumen', [RatingResumeController::class, 'resume']);
Route::match(['post'], '/realizar-test/{id}/{slug}/valorar', [RatingResumeController::class, 'rating']);

Route::get('/usuario/{username}', [UsersProfileController::class, 'show']);

Route::get('/registro', [UsersController::class, 'create']);
Route::post('/registro/crear', [UsersController::class, 'store']);

Route::get('login', [LoginController::class, 'create'])->name('login');
Route::post('login', [LoginController::class, 'store'])->name('login');
Route::patch('logout', [LoginController::class, 'destroy'])->middleware('auth');

//Para poder acceder a estas rutas es necesario estar autentificado
Route::middleware('auth')->group(function () {

    Route::get('/biblioteca', [LibrariesController::class, 'index']);
    Route::post('/biblioteca', [LibrariesController::class, 'store']);
    Route::patch('/biblioteca', [LibrariesController::class, 'destroy']);

    Route::get('/test/crear', [TestsController::class, 'create']);
    Route::post('/test/crear', [TestsController::class, 'store']);
    Route::delete('/test/{testId}/{userId}/eliminar', [TestsController::class, 'delete']);

    Route::get('/test/crear/pregunta', [QuestionsController::class, 'create']);
    Route::post('/test/crear/pregunta', [QuestionsController::class, 'store']);

    Route::get('/test/crear/respuesta', [AnswersController::class, 'create']);
    Route::post('/test/crear/respuesta', [AnswersController::class, 'store']);

    Route::get('/test/crear/accion', [ActionsController::class, 'create']);
    Route::post('/test/crear/accion', [ActionsController::class, 'redirect']);

    Route::get('/perfil', [UsersProfileController::class, 'showOwnProfile']);
    Route::get('/perfil/editar', [UsersProfileController::class, 'create']);
    Route::patch('/perfil/editar', [UsersProfileController::class, 'store']);
    Route::post('/perfil/avatar', [UsersProfileController::class, 'storeAvatar']);

    Route::get('/perfil/admin', [AdminController::class, 'create']);
    Route::post('/perfil/admin/categoria', [AdminController::class, 'storeCategory']);
    Route::post('/perfil/admin/idioma', [AdminController::class, 'storeLanguage']);

});