<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pieza;

class UserController extends Controller
{
    public function cliente()
    {
        $cliente = Auth::user();
        return response()->json($cliente);
    }
    public function destinos()
    {
        $destinos = Auth::user()->destinos;
        return response()->json($destinos);
    }
    public function compras()
    {
        $res = [];
        $compras = Auth::user()->compras;
        foreach($compras as $compra){
            $piezas = [];
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
    public function prueba()
    {
        $pieza = Pieza::find(1);
        return response()->json(date_create($pieza->detalleVenta[$pieza->detalleVenta->keys()->last()]->venta->created_at)->diff(date_create(date('Y-m-d'))));
    }
}
