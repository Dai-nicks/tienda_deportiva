<?php

namespace App\Models;

// Asegúrate de que esta línea esté, si usas Sanctum
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Schema;

class User extends Authenticatable
{
    // Agrega HasApiTokens si estás usando Laravel Sanctum para tu API
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The table associated with the model.
     * ¡ESTA ES LA LÍNEA QUE RESUELVE EL ERROR 500 DE LA TABLA!
     *
     * @var string
     */
    protected $table = 'tblUsuarios';
    // El nombre de la PK de la migración
    protected $primaryKey = 'id_usuario';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false; // La tabla usa fecha_registro

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nombre',
        'correo',
        'contrasena',
        'telefono',
        'direccion',
        'rol',
        'estado',
        'fecha_registro',
        'fecha_nacimiento',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'contrasena',
        'remember_token',
    ];

    /**
     * Accessor to read contrasena while supporting legacy column `contraseña`.
     */
    public function getContrasenaAttribute($value)
    {
        if (! empty($value)) {
            return $value;
        }

        // Fallback to legacy 'contraseña' column
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
        if (Schema::hasColumn($this->getTable(), 'contrasena')) {
            $this->attributes['contrasena'] = $value;
            return;
        }
        $this->attributes['contraseña'] = $value;
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
