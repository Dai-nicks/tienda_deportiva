<?php

namespace App\Services;

use App\Models\Carrito;
use Illuminate\Database\Eloquent\Collection;

class CarritoService
{
    public function obtenerCarritos(): Collection
    {
        return Carrito::with('usuario')->get();
    }

    public function crearCarrito(array $data): ?Carrito
    {
        // Prevenir segundo carrito del mismo usuario
        if (Carrito::where('id_usuario', $data['id_usuario'])->exists()) {
            return null; // Controlador responderá con 409
        }

        return Carrito::create($data);
    }

    public function obtenerCarritoPorId($id): ?Carrito
    {
        return Carrito::find($id);
    }

    public function actualizarCarrito($id, array $data): ?Carrito
    {
        $carrito = Carrito::find($id);

        if (! $carrito) {
            return null;
        }

        $carrito->update($data);
        return $carrito;
    }

    public function eliminarCarrito($id): bool
    {
        $carrito = Carrito::find($id);

        if (! $carrito) {
            return false;
        }

        $carrito->delete();
        return true;
    }

    public function restaurarCarrito($id): bool
    {
        $carrito = Carrito::withTrashed()->find($id);

        if (! $carrito || ! $carrito->trashed()) {
            return false;
        }

        $carrito->restore();
        return true;
    }
}
