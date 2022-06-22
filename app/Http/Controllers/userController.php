<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pieza;
use App\Models\Destino;

class UserController extends Controller
{
    public function cliente()
    {
        $cliente = Auth::user();
        return response()->json($cliente);
    }
    public function destinos()
    {
        $destinos = [];
        if (Auth::check()) $destinos = Auth::user()->destinos;
        return response()->json($destinos);
        
    }
    public function compras()
    {
        $res = [];
        $compras = Auth::user()->compras;
        foreach($compras as $compra){
            $piezas = [];
            $compra->destino;
            $detalles = $compra->detalles;
            foreach($detalles as $detalle){
                $pieza = $detalle->pieza;
                array_push($piezas,$pieza);
            }
            unset($detalle);
            array_push($res,array('venta'=>$compra,'piezas'=>$piezas));
        }
        unset($compra);
        return response()->json(array_reverse($res));
    }
    public function addDestino(Request $req)
    {
        $nuevoDestino = new Destino;
        $nuevoDestino->direccion = $req->input('direccion');
        $nuevoDestino->cp = $req->input('cp');
        $nuevoDestino->idUser = Auth::id();
        $nuevoDestino->save();
    }
}
