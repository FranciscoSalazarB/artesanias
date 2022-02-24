<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaLineaDetalle extends Model
{
    use HasFactory;
    protected $fillable = [
        'precioVenta',
        'porsentajeDescuento',
        'fechaRegistro',
    ];
}
