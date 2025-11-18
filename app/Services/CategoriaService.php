<?php

namespace App\Services;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Collection;

class CategoriaService
{
    public function obtenerCategorias(): Collection
    {
        return Categoria::all();
    }

    public function crearCategoria(array $data): Categoria
    {
        return Categoria::create($data);
    }

    public function obtenerCategoriaPorId($id): ?Categoria
    {
        return Categoria::find($id);
    }

    public function actualizarCategoria($id, array $data): ?Categoria
    {
        $categoria = Categoria::find($id);
        if (! $categoria) {
            return null;
        }

        $categoria->update($data);

        return $categoria;
    }

    public function eliminarCategoria($id): bool
    {
        $categoria = Categoria::find($id);

        if (! $categoria) {
            return false;
        }
        $categoria->activo = false;
        $categoria->save();

        return true;
    }

    public function restaurarCategoria($id): bool
    {
        $categoria = Categoria::withTrashed()->find($id);

        if (! $categoria || ! $categoria->trashed()) {
            return false;
        }

        $categoria->restore();

        return true;
    }
}