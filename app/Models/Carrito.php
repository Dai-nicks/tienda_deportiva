<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carrito extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tblCarrito';
    protected $primaryKey = 'id_carrito';
    public $timestamps = false;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id_usuario',
        'fecha_creacion',
        'estado',
        'total_carrito',
    ];

    // Relación: un carrito pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    // Relación: un carrito puede tener muchos ítems
    public function items()
    {
        return $this->hasMany(DetalleCarrito::class, 'id_carrito', 'id_carrito');
    }
}
