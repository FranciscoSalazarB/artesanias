<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Destino;
use App\Models\User;
use App\Models\VentaDetalle;
use App\Models\Evidencia;

class Venta extends Model
{
    use HasFactory;
    protected $table = 'venta';
    protected $fillable = [
        'status',
        'referenciaEnvio',
        'fechaLimitePago',
        'motivo',
        'fechaLimiteConfirmar',
        'fechaConfirmacion',
        'fechaCancelacion',
        'idUsuario',
        'idDestino'
    ];

    public function detalles()
    {
        return $this->hasMany(VentaDetalle::class,'idVenta');
    }
    public function destino()
    {
        return $this->belongsTo(Destino::class,'idDestino');
    }
    public function cliente()
    {
        return $this->belongsTo(User::class,'idUser');
    }
    public function evidencia()
    {
        return $this->hasMany(Evidencia::class,'idVenta');
    }
    public function caducado()
    {
        $salida = FALSE;
        if($this->status == "cancelado" or $this->status == "denegado") $salida = TRUE;
        if($this->status == "espera")
        {
            if ( date_create($this->fechaLimitePago) <  date_create(date('Y-m-d-G')) and count($this->evidencia)== 0) $salida = TRUE;
        }
        return $salida;
    }
}
