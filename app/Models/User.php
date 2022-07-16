<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Destino;
use App\Models\Venta;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'user';
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function destinos()
    {
        return $this->hasMany(Destino::class,'idUser');
    }
    public function compras()
    {
        return $this->hasMany(Venta::class,'idUser');
    }
    public function piezasApartadasSinPagar()
    {
        if(count($this->compras) == 0) return FALSE;
        $ultimoApartado = $this->compras[$this->compras->keys()->last()];
        if($ultimoApartado->status == "espera"){
            if(date_create($ultimoApartado->fechaLimitePago) > date_create(date('Y-m-d-G'))) return TRUE;
        }
        return FALSE;
    }
}
