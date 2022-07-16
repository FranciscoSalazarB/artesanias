<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destino extends Model
{
    use HasFactory;
    protected $table = 'destino';
    protected $fillable = [
        'idUsuario',
        'dirección',
        'cp',
        'estado',
        'municipio'
    ];
    public $timestamps = false;
}
