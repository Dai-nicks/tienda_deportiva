<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'productos';

    protected $primaryKey = 'id_producto';

    public $timestamps = false;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nombre_producto',
        'descripcion',
        'precio',
        'stock',
        'talla',
        'color',
        'imagen_url',
        'estado',
    ];

    public function categorias()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }
}
