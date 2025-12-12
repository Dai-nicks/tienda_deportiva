<?php

namespace App\Models;

// Asegúrate de que esta línea esté, si usas Sanctum
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'correo',
        'contraseña',
        'teléfono',
        'dirección',
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
        'contraseña',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'contraseña' => 'hashed',
        ];
    }
}
