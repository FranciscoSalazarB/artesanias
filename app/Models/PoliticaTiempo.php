<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoliticaTiempo extends Model
{
    use HasFactory;
    protected $table = 'politica_tiempo';
    protected $fillable = [
        'dia',
        'diasRelativosAvisoDePago',
        'diasRelativosAvisoDeConfirmacion'
    ];
    public $timestamps = false;
}
