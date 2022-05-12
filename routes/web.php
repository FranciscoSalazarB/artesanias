<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtesaniasController;
use App\Http\Controllers\CatalogoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ArtesaniasController::class,'index'])->name('/');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::post('/catalogo',[ArtesaniasController::class,'sendArtesanias'])->name('artesanias');
Route::post('/ramas',function(){
    return json('hola');
})->name('ramasGet');
Route::post('/rubros',[CatalogoController::class,'getRubros'])->name('rubrosGet');

require __DIR__.'/auth.php';
