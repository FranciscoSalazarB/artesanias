<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pieza;
use App\Models\Rama;
use App\Models\Rubro;

class ArtesaniasController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    public function sendRamas()
    {
        $ramas = Rama::all();
        foreach($ramas as $rama){
            $rubros = $rama->rubros;
            $pieza = array("rama"=>$rama,"rubros"=>$rubros);
        }
        unset($rama);
        return response()->json($ramas);
    }
    public function piezasInRubro(Request $req)
    {
        $rubro = Rubro::find($req->input('id'));
        $piezasElegidas = [];
        $productos = $rubro->productos;
        foreach($productos as $producto)
        {
            $piezas = $producto->piezas;
            foreach($piezas as $pieza)
            {
                $img = $pieza->fotos;
                $pieza = array("pieza"=>$pieza,"fotos"=>$img);
                array_push($piezasElegidas,$pieza);
            }
            unset($pieza);
        }
        unset($producto);
        return response()->json($piezasElegidas);
    }
}
