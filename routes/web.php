<?php
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtesaniasController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AjustesController;
use Illuminate\Support\Facades\Auth;

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

Route::post('/catalogo',[ArtesaniasController::class,'sendArtesanias'])->name('catalogo');
Route::post('/catalogo/ramas',[ArtesaniasController::class,'sendRamas']);
Route::post('/catalogo/rubros',[ArtesaniasController::class,'sendRubros']);
Route::post('/catalogo/piezasInRubro',[ArtesaniasController::class,'piezasInRubro']);
Route::post('/ramas',[CatalogoController::class,'getRamas'])->name('ramasGet');
Route::post('/ramas/add',[CatalogoController::class,'addRama']);
Route::post('/ramas/del',[CatalogoController::class,'delRama']);
Route::post('/ramas/edit',[CatalogoController::class,'editRama']);
Route::post('/ramas/reset',[CatalogoController::class,'resetRama']);
Route::post('/rubros',[CatalogoController::class,'getRubros'])->name('rubrosGet');
Route::post('/rubros/add',[CatalogoController::class,'addRubro']);
Route::post('/rubros/edit',[CatalogoController::class,'editRubro']);
Route::post('/rubros/del', function (Request $req){
    app(CatalogoController::class)->delRubro($req->input('id'));
});
Route::post('/rubros/reset',[CatalogoController::class,'resetRubro']);
Route::post('/productos',[CatalogoController::class,'getProductos'])->name('productosGet');
Route::post('/productos/add',[CatalogoController::class,'addProducto']);
Route::post('/productos/edit',[CatalogoController::class,'editProducto']);
Route::post('/productos/del', function(Request $req){
    app(CatalogoController::class)->delProducto($req->input('id'));
});
Route::post('/productos/reset',[CatalogoController::class,'resetProducto']);
Route::post('/piezas',[CatalogoController::class,'getPiezas'])->name('piezasGet');
Route::post('/piezas/add',[CatalogoController::class,'addPieza']);
Route::post('/piezas/edit',[CatalogoController::class,'editPieza']);
Route::post('/piezas/del',function (Request $req){
    app(CatalogoController::class)->delPieza($req->input('id'));
});
Route::post('/piezas/reset',[CatalogoController::class,'resetPieza']);
Route::post('/piezas/addImg',[CatalogoController::class,'addImg'])->name('addImg');
Route::post('/carrito/getPiezas',[CarritoController::class,'getCarrito'])->name('carritoGet');
Route::post('/carrito/addPieza',[CarritoController::class,'addToCarrito'])->name('carritoAdd');
Route::post('/carrito/removePieza',[CarritoController::class,'removeCarrito'])->name('carritoRemove');
Route::post('/carrito/guardar',[CarritoController::class,'GuardarCarrito'])->name('carritoGuardar');
Route::post('/cliente',[UserController::class,'cliente'])->name('cliente');
Route::post('/cliente/compras',[UserController::class,'compras']);
Route::post('/cliente/addEvidencia',[UserController::class,'addEvidencia']);
Route::post('/cliente/destinos',[UserController::class,'destinos'])->name('destinosUser');
Route::post('/cliente/agregarDestino',[UserController::class,'addDestino'])->name('addDestino');

Route::post('/pedidos',[CarritoController::class,'getPedidos'])->name('adminPedidos');
Route::post('/pedidos/pagado',[CarritoController::class,'pagarPedido']);
Route::post('/ajustes',[AjustesController::class,'getAjustes'])->name('ajustes');
Route::post('/ajustes/guardar',[AjustesController::class,'saveAjustes']);

require __DIR__.'/auth.php';
