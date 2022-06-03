<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Venta;
use App\Models\Pieza;

class VentaDetalle extends Model
{
    use HasFactory;
    protected $table = 'venta_detalle';
    protected $fillable = [
        'idPieza',
        'idVenta'
    ];

    public function pieza()
    {
        return $this->belongsTo(Pieza::class,'idPieza');
    }
    public function venta()
    {
        return $this->belongsTo(Venta::class,'idVenta');
    }
}
