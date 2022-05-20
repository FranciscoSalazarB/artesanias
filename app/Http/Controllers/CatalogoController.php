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
        $newRama->save(); 
    }
    public function editRama(Request $req, $id)
    {
        $ramaEdit = Rama::find($id);
        $ramaEdit->rama = $req->input('rama');
        $ramaEdit->save();
    }
    public function delRama($id)
    {
        $ramaDel = Rama::find($id);
        $ramaDel->eliminado = TRUE;
        $ramaDel->save();
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
        $newRubro->save();
    }
    public function editRubro(Request $req, $id)
    {
        $rubroEdit = Rubro::find($id);
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
        $newRubro = new Rubro;
        $newRubro->rubro = $req->input('rubro');
        $newRubro->idRama = $req->input('idRama');
        $newRubro->save();
    }
    public function editProducto(Request $req, $id)
    {
        $rubroEdit = Rubro::find($id);
        $rubroEdit->rubro = $req->input('rubro');
        $rubroEdit->save();
    }
    public function delProducto($id)
    {
        $rubroDel = Rubro::find($id);
        $rubroDel->eliminado = TRUE;
        $rubroDel->save();
    }

    #piezas
    public function getPiezas()
    {
        return response()->json(Pieza::all());
    }

    #Fotos
    public function getFotos()
    {
        return response()->json(Foto::all());
    }
}