<?php

namespace App\Services;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Collection;

class ProductoService
{
    public function obtenerProductos(): Collection
    {
        return Producto::with('categoria')->get();
    }

    public function crearProducto($data): Producto
    {
        return Producto::create($data);
    }

    public function obtenerProductoPorId($id): ?Producto
    {
        return Producto::find($id);
    }

    public function actualizarProducto($id, array $data): ?Producto
    {
        $producto = Producto::find($id);

        if (! $producto) {
            return null;
        }

        $producto->update($data);

        return $producto;
    }

    public function eliminarProducto($id): bool
    {
        $producto = Producto::find($id);

        if (! $producto) {
            return false;
        }
        $producto->delete();

        return true;
    }

    public function restaurarProducto($id): bool
    {
        $producto = Producto::withTrashed()->find($id);

        if (! $producto || ! $producto->trashed()) {
            return false;
        }

        $producto->restore();

        return true;
    }
}
