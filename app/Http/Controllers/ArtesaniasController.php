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
        $ramas = Rama::where('eliminado',FALSE)->get();
        return response()->json($ramas);
    }
    public function sendRubros(Request $req){
        $rubrosRes = [];
        $rubros = Rubro::where('idRama',$req->input('id'))->get();
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
                if($pieza->estatus == "activo"){
                    $img = $pieza->fotos;
                    $pieza = array("pieza"=>$pieza,"fotos"=>$img);
                    array_push($piezasElegidas,$pieza);
                }else{
                    if($pieza->estatus == 'apartado'){
                        $dif = date_create($pieza->detalleVenta[$pieza->detalleVenta->keys()->last()]->venta->created_at)->diff(date_create(date('Y-m-d')));
                        if($dif->y >= 1 or $dif->m >=1 or $dif->d >=1){
                            $img = $pieza->fotos;
                            $pieza = array("pieza"=>$pieza,"fotos"=>$img);
                            array_push($piezasElegidas,$pieza);
                        }
                    }
                }
            }
            unset($pieza);
        }
        unset($producto);
        return response()->json($piezasElegidas);
    }
}
