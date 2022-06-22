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
                $pieza->fotos;
                if($this->piezaLibre($pieza)) array_push($res,$pieza);
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

    public function GuardarCarrito(Request $req)
    {
        $piezasNoDisponibles = [];
        $idPiezas = session('carrito');
        foreach($idPiezas as $idPieza){
            $pieza = Pieza::find($idPieza);
            if(!($this->piezaLibre($pieza))){
                array_push($piezasNoDisponibles,$pieza);
                $this->delPieza($idPieza);
            }
        }
        if(count($piezasNoDisponibles)>=1){
            return response()->json($piezasNoDisponibles);
        }
        $venta = new Venta;
        $venta->idUser = Auth::id();
        $venta->idDestino = $req->input('idDestino');
        $venta->referenciaEnvio = "";
        $venta->save();
        foreach($idPiezas as $idPieza){
            $referencia = new VentaDetalle;
            $referencia->idVenta = $venta->id;
            $referencia->idPieza = $idPieza;
            $referencia->save();
            $this->apartarPieza($idPieza);
        }
        unset($idPieza);
        session()->put('carrito',[]);
        return response()->json($piezasNoDisponibles);
    }

    public function apartarPieza($id)
    {
        $pieza = Pieza::find($id);
        $pieza->estatus = "apartado";
        $pieza->save();
    }
    public function piezaLibre($pieza)
    {
        $salida = FALSE;
        if($pieza->estatus == "activo") $salida = TRUE;
        if ($pieza->estatus == "apartado") {
            $dif = date_create($pieza->detalleVenta[$pieza->detalleVenta->keys()->last()]->venta->created_at)->diff(date_create(date('Y-m-d')));
            $salida = ($dif->y >= 1 or $dif->m >=1 or $dif->d >=1);
        }
        return $salida;
    }
    public function delPieza($idPieza)
    {
        $carrito = session('carrito');
        if(in_array($idPieza,$carrito)){
            unset($carrito[array_search($idPieza,$carrito)]);
        }
        session()->put('carrito',$carrito);
    }
    public function getPedidos()
    {
        $salida = [];
        $pedidos = Venta::where('vendido',FALSE)->get();
        foreach($pedidos as $pedido){
            $dif = date_create($pedido->created_at)->diff(date_create(date('Y-m-d')));
            if (!($dif->y >= 1 or $dif->m >=1 or $dif->d >=1)) {
                $pedido->cliente;
                $pedido->destino;
                foreach($pedido->detalles as $detalle){
                    $detalle->pieza;
                }
                unset($detalle);
                array_push($salida,$pedido);
            }
        }
        unset($pedido);
        return response()->json($salida);
    }
    public function pagarPedido(Request $req)
    {
        $venta = Venta::find($req->input('idPedido'));
        $venta->vendido = TRUE;
        $venta->save();
        foreach($venta->detalles as $detalle){
            $pieza = $detalle->pieza;
            $pieza->estatus ="vendido";
            $pieza->save();
        }
        unset($detalle);
    }
}
