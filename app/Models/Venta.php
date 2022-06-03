<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Destino;
use App\Models\VentaDetalle;

class Venta extends Model
{
    use HasFactory;
    protected $table = 'venta';
    protected $fillable = [
        'vendido',
        'referenciaEnvio',
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
}
