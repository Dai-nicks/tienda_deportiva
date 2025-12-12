<?php

namespace App\Services;

use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioService
{
    public function obtenerUsuarios()
    {
        return Usuario::all();
    }

    public function crearUsuario(array $data)
    {
        $data['contrasena'] = Hash::make($data['contrasena']);

        return Usuario::create($data);
    }

    public function obtenerUsuarioPorId($id)
    {
        return Usuario::find($id);
    }

    public function actualizarUsuario($id, array $data)
    {
        $usuario = Usuario::find($id);
        if (! $usuario) {
            return null;
        }

        if (! empty($data['contrasena'])) {
            $data['contrasena'] = Hash::make($data['contrasena']);
        } else {
            unset($data['contrasena']);
        }

        $usuario->update($data);

        return $usuario;
    }

    public function eliminarUsuario($id)
    {
        $usuario = Usuario::find($id);

        if (! $usuario) {
            return false;
        }

        $usuario->delete();

        return true;
    }

    public function restaurarUsuario($id): bool
    {
        $usuario = Usuario::withTrashed()->find($id);

        if (! $usuario || ! $usuario->trashed()) {
            return false;
        }

        $usuario->restore();

        return true;
    }
}
