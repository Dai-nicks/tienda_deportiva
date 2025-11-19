<?php

namespace App\Services;

use App\Models\Personalizacion;
use Illuminate\Database\Eloquent\Collection;

class PersonalizacionService
{
    public function obtenerPersonalizaciones(): Collection
    {
        return Personalizacion::with(['producto', 'usuario'])->get();
    }

    public function crearPersonalizacion($data): Personalizacion
    {
        return Personalizacion::create($data);
    }

    public function obtenerPersonalizacionPorId($id): ?Personalizacion
    {
        return Personalizacion::find($id);
    }

    public function actualizarPersonalizacion($id, array $data): ?Personalizacion
    {
        $personalizacion = Personalizacion::find($id);

        if (! $personalizacion) {
            return null;
        }

        $personalizacion->update($data);

        return $personalizacion;
    }

    public function eliminarPersonalizacion($id): bool
    {
        $personalizacion = Personalizacion::find($id);

        if (! $personalizacion) {
            return false;
        }

        $personalizacion->delete();

        return true;
    }

    public function restaurarPersonalizacion($id): bool
    {
        $personalizacion = Personalizacion::withTrashed()->find($id);

        if (! $personalizacion || ! $personalizacion->trashed()) {
            return false;
        }

        $personalizacion->restore();

        return true;
    }
}
