<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $ramaDel = Rama::find($req->input('id'));
        $ramaDel->eliminado = TRUE;
        $ramaDel->save();
        foreach($ramaDel->rubros as $rubroDel)
        {
            $this->delRubro($rubroDel->id);
        }
        unset($rubroDel);
    }
    public function resetRama(Request $req)
    {
        $ramaReset = Rama::find($req->input('id'));
        $ramaReset->eliminado = FALSE;
        $ramaReset->save();
    }

    #Sección rubro--------------------------------------------------------------------
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
        foreach($rubroDel->productos as $productoDel)
        {
            $this->delProducto($productoDel->id);
        }
        unset($productoDel);
    }
    public function resetRubro(Request $req)
    {
        $rubroReset = Rubro::find($req->input('id'));
        if (!($rubroReset->rama->eliminado)) {
            $rubroReset->eliminado = FALSE;
            $rubroReset->save();
        }  
    }

    #Sección productos---------------------------------------------------------------------
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
        $productoDel = Product::find($id);
        $productoDel->eliminado = TRUE;
        $productoDel->save();
        foreach($productoDel->piezas as $piezaDel)
        {
            $this->delPieza($piezaDel->id);
        }
        unset($piezaDel);
    }
    public function resetProducto(Request $req)
    {
        $productoReset = Product::find($req->input('id'));
        if (!($productoReset->rubro->rama->eliminado or $productoReset->rubro->eliminado)) {
            $productoReset->eliminado = FALSE;
            $productoReset->save();
        }  
    }


    #sección de artezanías/piezas-----------------------------------------------------------------
    public function getPiezas()
    {
        $piezas = Pieza::all();
        if (true === ( isset( $my_var ) ? $my_var : null )) {
            return response()->json(["error"=>"no hay piezas"]);
        }
        else{
            foreach($piezas as $pieza){
                $img = $pieza->fotos;
                $img[0]->url = url('/');
                $pieza = array("pieza"=>$pieza,"fotos"=>$img);
            }
            unset($pieza);
            return response()->json($piezas);
        }
    }
    public function addPieza(Request $req)
    {
       $newPieza = new Pieza;
       $newPieza->nombre = $req->input('nombre');
       $newPieza->precio = $req->input('precio');
       $newPieza->codigoAlterno = $req->input('codigoAlterno');
       $newPieza->idProducto = $req->input('idProducto');
       $newPieza->save();
       $img = $req->file('img')->store('public/imgPieza');
       $url = Storage::url($img);
       $newFoto = new Foto;
       $newFoto->nombreArchivo = $url;
       $newFoto->url = "";
       $newFoto->eliminado = FALSE;
       $newFoto->idPieza = $newPieza->id;
       $newFoto->save();
    }
    public function editPieza(Request $req)
    {
       $pieza = Pieza::find($req->input('id'));
       $pieza->nombre = $req->input('nombre');
       $pieza->precio = $req->input('precio');
       $pieza->codigoAlterno = $req->input('codigoAlterno');
       $pieza->save();
    }
    public function delPieza($id)
    {
        $piezaDel = Pieza::find($id);
        $piezaDel->estatus = "eliminado";
        $piezaDel->save();
    }
    public function resetPieza(Request $req)
    {
        $piezaReset = Pieza::find($req->input('id'));
        if (!($piezaReset->producto->rubro->rama->eliminado or $piezaReset->producto->rubro->eliminado or $piezaReset->producto->eliminado)) {
            $piezaReset->estatus = "activo";
            $piezaReset->save();
        }
    }
}