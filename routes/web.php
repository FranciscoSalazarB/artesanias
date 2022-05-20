<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtesaniasController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\CarritoController;

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
Route::post('/ramas',[CatalogoController::class,'getRamas'])->name('ramasGet');
Route::post('/rubros',[CatalogoController::class,'getRubros'])->name('rubrosGet');
Route::post('/productos',[CatalogoController::class,'getProductos'])->name('productosGet');
Route::post('/piezas',[CatalogoController::class,'getPiezas'])->name('piezasGet');
Route::post('/carrito/getPiezas',[CarritoController::class,'getCarrito'])->name('carritoGet');
Route::post('/carrito/addPieza',[CarritoController::class,'addToCarrito'])->name('carritoAdd');
Route::post('/carrito/removePieza',[CarritoController::class,'removeCarrito'])->name('carritoRemove');

require __DIR__.'/auth.php';
