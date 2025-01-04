<?php

use App\Http\Controllers\EntradesController;
use App\Http\Controllers\PeliculesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeientsController;


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
    $peliculas = App\Models\Pelicules::all();

    // Passa las películas a la vista home
    return view('home', compact('peliculas'));
   
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/lang/{idioma}', 'App\Http\Controllers\LocalizationController@index')
    ->where('idioma', 'ca|en|es|fr');

Route::get('/infofilms/{id}', [PeliculesController::class, 'show'])->name('infofilms');

Route::get('/seients', [SeientsController::class, 'mostrarSeients'])->name('seients');


Route::get('/compra', [SeientsController::class, 'showCompra'])->name('compra');

Route::get('/pagat', [EntradesController::class, 'processPayment'])->name('pagat');


Route::get('/tiquets', [EntradesController::class, 'showEntrades'])->name('tiquets');


Route::delete('/entrades/{id}', [EntradesController::class, 'destroy'])->name('entrades.delete');

Route::get('/crearPelicula', [PeliculesController::class, 'crearPelicula'])->name('crearPelicula');




Route::middleware(['auth', 'can:administrar'])->group(function () {
    Route::get('/afegir-pelicula', [PeliculesController::class, 'crear'])->name('afegirPelicula');
    Route::post('/guardar-pelicula', [PeliculesController::class, 'guardar'])->name('guardarPelicula');
});

Route::get('/editar-pelicula/{id}', [PeliculesController::class, 'edit'])->name('editarPelicula');


Route::post('/pelicula/editar/{id}', [PeliculesController::class, 'update'])->name('guardarPeli');


require __DIR__.'/auth.php';
