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
        $ramas = Rama::where('eliminado',FALSE)->orderBy('rama', 'asc')->get();
        return response()->json($ramas);
    }
    public function sendRubros(Request $req){
        $rubrosRes = [];
        $rubros = Rubro::where('idRama',$req->input('id'))->orderBy('rubro', 'asc')->get();
        foreach($rubros as $rubro){
            if(!$rubro->eliminado){
                array_push($rubrosRes,$rubro);
            }
        }
        return response()->json($rubrosRes);
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
                $pieza->fotos;
                $pieza->fotos[0]->url = url('/');
                $pieza->producto;
                if($pieza->estoyLibre()) array_push($piezasElegidas,$pieza);
            }
            unset($pieza);
        }
        unset($producto);
        return response()->json($piezasElegidas);
    }
}
