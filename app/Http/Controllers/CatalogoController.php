<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rama;
use App\Models\Rubro;
use App\Models\Product;
use App\Models\Pieza;
use App\Models\Foto;



class CatalogoController extends Controller
{
    public function getRamas()
    {
        return response()->json(Rama::all());
    }
    public function addRama(Request $req)
    {
        $newRama = new Rama;
        $newRama->rama = $req->input('rama');
        $newRama->eliminado = false;
        $newRama->save(); 
    }
    public function editRama(Request $req)
    {
        $ramaEdit = Rama::find($req->input('id'));
        $ramaEdit->rama = $req->input('rama');
        $ramaEdit->save();
    }
    public function delRama(Request $req)
    {
        return response()->json($req);
        #$ramaDel = Rama::find($req->input('id'));
        #$ramaDel->eliminado = TRUE;
        #$ramaDel->save();
    }


    #Sección rubro
    public function getRubros()
    {
        return response()->json(Rubro::all());
    }
    public function addRubro(Request $req)
    {
        $newRubro = new Rubro;
        $newRubro->rubro = $req->input('rubro');
        $newRubro->idRama = $req->input('idRama');
        $newRubro->eliminado = FALSE;
        $newRubro->save();
    }
    public function editRubro(Request $req)
    {
        $rubroEdit = Rubro::find($req->input('id'));
        $rubroEdit->rubro = $req->input('rubro');
        $rubroEdit->save();
    }
    public function delRubro($id)
    {
        $rubroDel = Rubro::find($id);
        $rubroDel->eliminado = TRUE;
        $rubroDel->save();
    }

    #Sección productos
    public function getProductos()
    {
        return response()->json(Product::all());
    }
    public function addProducto(Request $req)
    {
        $newProducto = new Product;
        $newProducto->descripcion = $req->input('descripcion');
        $newProducto->unidadDeMedida = $req->input('unidadDeMedida');
        $newProducto->idRubro = $req->input('idRubro');
        $newProducto->eliminado = FALSE;
        $newProducto->save();
    }
    public function editProducto(Request $req)
    {
        $rubroEdit = Product::find($req->input('id'));
        $rubroEdit->descripcion = $req->input('descripcion');
        $rubroEdit->unidadDeMedida = $req->input('unidadDeMedida');
        $rubroEdit->save();
    }
    public function delProducto($id)
    {
        $rubroDel = Rubro::find($id);
        $rubroDel->eliminado = TRUE;
        $rubroDel->save();
    }
    public function addPieza(Request $req)
    {
       $newPieza = new Pieza;
       $newPieza->nombre = $req->input('nombre');
       $newPieza->precio = $req->input('precio');
       $newPieza->codigoAlterno = $req->input('codigoAlterno');
       $newPieza->idProducto = $req->input('idProducto');
       $newPieza->save();
    }
    public function editPieza(Request $req)
    {
       $pieza = Pieza::find($req->input('id'));
       $pieza->nombre = $req->input('nombre');
       $pieza->precio = $req->input('precio');
       $pieza->codigoAlterno = $req->input('codigoAlterno');
       $pieza->save();
    }
}