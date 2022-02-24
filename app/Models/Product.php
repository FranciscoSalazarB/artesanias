<?php

namespace App\Models;

use App\Models\Inventario;
use App\Models\Foto;
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

    public function inventario()
    {
        return $this->hasOne(Inventario::class,'idProduct');
    }
    public function fotos()
    {
        return $this->hasMany(Foto::class,'idProduct');
    }
}
