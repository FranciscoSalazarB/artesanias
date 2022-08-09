<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pieza;
use App\Models\Venta;
use App\Models\VentaDetalle;
use App\Models\PoliticaTiempo;

class CarritoController extends Controller
{
    public function getCarrito()
    {
        $user = Auth::user();
        if($user->piezasApartadasSinPagar()) return response()->json('Nompuede apartar más productos, No haz pagado el último carrito apartado');
        $res = [];
        if (session()->has('carrito')) {
            $idsPiezas = session('carrito');
            foreach ($idsPiezas as $idPieza) {
                $pieza = Pieza::find($idPieza);
                $pieza->fotos;
                if($pieza->estoyLibre()) array_push($res,$pieza);
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
            if(!($pieza->estoyLibre())){
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
        $venta->motivo = "";
        $hoy = PoliticaTiempo::where('dia',date('l'))->first();
        $fechaLimitePago = date_create(date('Y-m-d'));
        $fechaLimiteConfirmar = date_create(date('Y-m-d'));
        date_add($fechaLimitePago,date_interval_create_from_date_string($hoy->diasRelativosAvisoDePago." days"));
        date_add($fechaLimiteConfirmar,date_interval_create_from_date_string(($hoy->diasRelativosAvisoDePago + $hoy->diasRelativosAvisoDeConfirmacion)." days"));
        $fechaLimitePago->modify('+23 hours');
        $fechaLimiteConfirmar->modify('+23 hours');
        $venta->fechaLimitePago = $fechaLimitePago;
        $venta->fechaLimiteConfirmar = $fechaLimiteConfirmar;
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
        $pedidos = Venta::where('status','porConfirmar')->orWhere('status','confirmado')->get();
        foreach($pedidos as $pedido){
            $pedido->evidencia;
            $pedido->cliente;
            $pedido->destino;
            foreach($pedido->detalles as $detalle){
                $detalle->pieza;
            }
            unset($detalle);
        }
        unset($pedido);
        return response()->json($pedidos);
    }
    public function pagarPedido(Request $req)
    {
        $venta = Venta::find($req->input('idPedido'));
        $venta->status = 'confirmado';
        $venta->fechaConfirmacion = date_create(date('Y-m-d-G'));
        $venta->save();
        foreach($venta->detalles as $detalle){
            $pieza = $detalle->pieza;
            $pieza->estatus ="vendido";
            $pieza->save();
        }
        unset($detalle);
    }
    public function denegarPedido(Request $req)
    {
        $venta = Venta::find($req->input('idPedido'));
        $venta->status = 'denegado';
        $venta->motivo = $req->input('motivo');
        $venta->fechaCancelacion = date_create(date('Y-m-d-G'));
        $venta->save();
    }
    public function subirGuiaEnvio(Request $req)
    {
        $venta = Venta::find($req->input('idPedido'));
        $venta->referenciaEnvio = $req->input('referencia');
        $venta->status = 'vendido';
        $venta->save();
    }
    public function historico()
    {
        $salida = [];
        $pedidos = Venta::whereIn('status',array('confirmado','cancelado','denegado','espera'))->get();
        foreach($pedidos as $pedido){
            if($pedido->status == 'espera'){
                if(!$pedido->caducado()) continue;
            }
            $pedido->cliente;
            $pedido->destino;
            foreach($pedido->detalles as $detalle){
                $detalle->pieza;
            }
            array_push($salida,$pedido);
            unset($detalle);
        }
        unset($pedido);
        return response()->json($salida);
    }
}
