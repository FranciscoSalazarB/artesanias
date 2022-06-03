<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Foto;
use App\Models\VentaDetalle;


class Pieza extends Model
{
    use HasFactory;
    protected $table = 'pieza';
    protected $fillable = [
        'nombre',
        'precio',
        'estatus',
        'codigoAlterno'
    ];
    public function producto()
    {
        return $this->belongsTo(Product::class,'idProducto');
    }
    public function fotos()
    {
        return $this->hasMany(Foto::class,'idPieza');
    }
    public function detalleVenta()
    {
        return $this->hasMany(VentaDetalle::class,'idPieza');
    }
}
