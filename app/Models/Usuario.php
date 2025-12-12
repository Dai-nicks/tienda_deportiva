<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;

class Usuario extends Model
{
    use HasFactory;
    use SoftDeletes;

    // Usamos la misma tabla que la migración y otras referencias del proyecto
    protected $table = 'tblUsuarios';

    // Llave primaria estandarizada por la migración
    protected $primaryKey = 'id_usuario';
    public $incrementing = true;
    protected $keyType = 'int';

    // No usamos created_at/updated_at por que la tabla usa fecha_registro
    public $timestamps = false;

    protected $fillable =[
        'nombre',
        'apellido',
        'documento',
        'correo',
        'contrasena',
        'telefono',
        'direccion',
        'rol',
        'estado',
        'fecha_registro',
        'fecha_nacimiento',
    ];

    protected $hidden = [
        'contrasena',
    ];

    /**
     * Accessor to read contrasena while supporting legacy column `contraseña`.
     */
    public function getContrasenaAttribute($value)
    {
        if (! empty($value)) {
            return $value;
        }

        // Fallback to legacy 'contraseña' column if present
        if (array_key_exists('contraseña', $this->attributes)) {
            return $this->attributes['contraseña'];
        }

        return null;
    }

    /**
     * Mutator to write contrasena into the available column (contrasena or contraseña)
     */
    public function setContrasenaAttribute($value)
    {
        // Prefer new column if exists
        if (Schema::hasColumn($this->getTable(), 'contrasena')) {
            $this->attributes['contrasena'] = $value;
            return;
        }

        // Otherwise write to legacy column name if present
        $this->attributes['contraseña'] = $value;
    }
}
