<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pieza;

class ArtesaniasController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    public function sendArtesanias()
    {
        $piezas = Pieza::all();
        if (true === ( isset( $my_var ) ? $my_var : null )) {
            return response()->json(["error"=>"no hay piezas"]);
        }
        else{
            foreach($piezas as $pieza){
                $img = $pieza->fotos;
                $pieza = array("pieza"=>$pieza,"fotos"=>$img);
            }
            unset($pieza);
            return response()->json($piezas);
        }
    }
}
