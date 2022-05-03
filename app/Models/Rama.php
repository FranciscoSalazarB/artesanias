<?php

namespace App\Models;

use App\Models\Rubro;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rama extends Model
{
    use HasFactory;
    protected $table = 'rama';
    protected $fillable = [
        'rama',
        'eliminado'
    ];
    public function rubros(){
        return $this->hasMany(Rubro::class,'idRama');
    }
}
