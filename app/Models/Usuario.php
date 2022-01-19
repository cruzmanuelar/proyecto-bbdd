<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Usuario extends Model implements JWTSubject
{
    use HasFactory;



    protected $fillable = [
        'nombre',
        'imagen',
        'correo',
        'empresa_ruc',
    ];

    protected $table = 'usuario';

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
