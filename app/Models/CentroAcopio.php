<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentroAcopio extends Model
{
    use HasFactory;

    protected $fillable = [
        'direccion',
        'nombre',
        'empresa_ruc',
        'centroacopio_producto_id',
    ];

    protected $table = 'centro_acopio';
}
