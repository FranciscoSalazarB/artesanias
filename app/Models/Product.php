<?php

namespace App\Models;

use App\Models\Pieza;
use App\Models\Rubro;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'producto';
    protected $fillable = [
        'unidadDeMedida',
        'eliminado',
        'descripcion',
        'marcaChiapas'
    ];

    public function piezas()
    {
        return $this->hasMany(Pieza::class,'idProducto');
    }
    public function rubro()
    {
        return $this->belongsTo(Rubro::class,'idRubro');
    }
}
