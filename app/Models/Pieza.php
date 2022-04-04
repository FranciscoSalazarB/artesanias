<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Foto;


class Pieza extends Model
{
    use HasFactory;
    protected $table = 'piezas';
    protected $fillable = [
        'nombre',
        'precio',
        'status',
        'codigoAlterno',
        'venta',
    ];
    public function producto()
    {
        return $this->hasManybelongsTo(Product::class,'idProduct');
    }
    public function fotos()
    {
        return $this->hasMany(Foto::class,'idPieza');
    }
}
