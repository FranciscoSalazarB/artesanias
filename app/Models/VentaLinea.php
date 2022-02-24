<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaLinea extends Model
{
    use HasFactory;
    protected $fillable = [
        'folioVenta',
        'costoEnvio',
        'fechaEnvio',
        'descuento',
        'facturaEnviada',
        'importe',
        'fechaRecibo',
    ];
}
