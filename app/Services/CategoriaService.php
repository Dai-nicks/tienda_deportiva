<?php

namespace App\Services;

use App\Models\Categoria;

class CategoriaService
{
    public function obtenerCategorias()
    {
        return Categoria::all();
    }

    public function crearCategoria(array $data)
    {
        return Categoria::create($data);
    }

    public function obtenerCategoriaPorId($id)
    {
        return Categoria::find($id);
    }

    public function actualizarCategoria($id, array $data)
    {
        $categoria = Categoria::find($id);
        if (! $categoria) {
            return null;
        }

        $categoria->update($data);

        return $categoria;
    }

    public function eliminarCategoria($id)
    {
        $categoria = Categoria::find($id);

        if (! $categoria) {
            return null;
        }
        $categoria->activo = false;
        $categoria->save();

        return true;
    }
}