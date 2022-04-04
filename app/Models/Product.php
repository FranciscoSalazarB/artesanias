<?php

namespace App\Models;

use App\Models\Pieza;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'unidadDeMedida',
        'eliminado',
        'descripcion',
        'marcaChiapas'
    ];

    public function piezas()
    {
        return $this->hasMany(Pieza::class,'idProduct');
    }
}
