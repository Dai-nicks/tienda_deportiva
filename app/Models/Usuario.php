<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $pimaryKey = 'id-usuario';

    protected $timestamp = false;

    protected $fillable =[
        'nombre',
        'apellido',
        'documento',
        'correo',
        'contraseña',
        'teléfono',
        'dirección',
        'rol',
        'estado',
        'fecha_registro',
        'fecha_nacimiento',
    ];

    protected $hidden = [
        'contraseña',
    ];
}
