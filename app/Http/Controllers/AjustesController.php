<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PoliticaTiempo;

class AjustesController extends Controller
{
    public function getAjustes()
    {
        $ajustes = PoliticaTiempo::all();
        return response()->json($ajustes);
    }
    public function saveAjustes(Request $req)
    {
        $cambios = (object)$req->input('cambios');
        foreach($cambios as $cambio){
            $politica = PoliticaTiempo::find($cambio['id']);
            $politica->diasRelativosAvisoDeConfirmacion = $cambio['diasRelativosAvisoDeConfirmacion'];
            $politica->diasRelativosAvisoDePago = $cambio['diasRelativosAvisoDePago'];
            $politica->save();
        }
        unset($cambio);
    }
}
