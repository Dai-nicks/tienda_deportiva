<?php 

namespace App\Services;

use App\Models\Usuario;

class UsuarioService
{
    public function obtenerUsuarios()
    {
        return Usuario::all();
    }

    public function crearUsuario(array $data)
    {
        $data['contraseña'] = Hash::make($data['contraseña']);

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

        if (! empty($data['contraseña'])) {
            $data['contraseña'] = Hash::make($data['contraseña']);
        } else {
            unset($data['contraseña']);
        }

        $usuario->update($data);

        return $usuario;
    }

    public function eliminarUsuario($id)
    {
        $usuario = Usuario::find($id);

        if (! $usuario) {
            return null;
        }
        $usuario->activo = false;
        $usuario->save();

        return true;
    }
}