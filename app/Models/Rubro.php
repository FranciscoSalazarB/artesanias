<?php

namespace App\Models;
use App\Models\Rama;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rubro extends Model
{
    use HasFactory;
    protected $table = 'rubro';
    protected $fillable = [
        'rubro',
        'eliminado'
    ];
    
    public function productos()
    {
        return $this->hasMany(Product::class,'idRubro');
    }
    public function rama()
    {
        return $this->belongsTo(Rama::class,'idRama');
    }
}
