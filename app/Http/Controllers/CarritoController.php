<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pieza;
use App\Models\Venta;
use App\Models\VentaDetalle;

class CarritoController extends Controller
{
    public function getCarrito()
    {
        $res = [];
        if (session()->has('carrito')) {
            $idsPiezas = session('carrito');
            foreach ($idsPiezas as $idPieza) {
                $pieza = Pieza::find($idPieza);
                array_push($res,$pieza);
            }
            unset($idPieza);
        }
        return response()->json($res);
    }

    public function addToCarrito(Request $req)
    {
        if(!session()->has('carrito')){
            session(['carrito'=>array()]);
        }
        $carrito = session('carrito');
        array_push($carrito,$req->input('idPieza'));
        session()->put('carrito',$carrito);
        return response()->json(session('carrito'));
    }

    public function removeCarrito(Request $req)
    {
        $carrito = session('carrito');
        if(in_array($req->input('idPieza'),$carrito)){
            unset($carrito[array_search($req->input('idPieza'),$carrito)]);
        }
        session()->put('carrito',$carrito);
        return response()->json(session('carrito'));
    }

    public function GuardarCarrito()
    {
        $venta = new Venta;
        $venta->idUser = Auth::id();
        $venta->idDestino = 1;
        $venta->referenciaEnvio = "";
        $venta->save();
        $idPiezas = session('carrito');
        foreach($idPiezas as $idPieza){
            $referencia = new VentaDetalle;
            $referencia->idVenta = $venta->id;
            $referencia->idPieza = $idPieza;
            $referencia->save();
            $this->apartarPieza($idPieza);
        }
        unset($idPieza);
        session()->put('carrito',[]);
        return redirect()->route('dashboard');
    }

    public function apartarPieza($id)
    {
        $pieza = Pieza::find($id);
        $pieza->estatus = "apartado";
        $pieza->save();
    }
}
