<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Personalizacion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tblPersonalizacion';

    protected $primaryKey = 'id_personalizacion';

    public $timestamps = false;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id_producto',
        'id_usuario',
        'tipo_perzonalizacion',
        'talla',
        'precio_total_personalizacion',
        'diseño',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}
