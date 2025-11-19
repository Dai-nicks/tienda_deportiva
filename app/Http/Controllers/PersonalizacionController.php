<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestPersonalizacion;
use App\Services\PersonalizacionService;
use Illuminate\Http\JsonResponse;

class PersonalizacionController extends Controller
{
    protected $personalizacionService;

    public function __construct(PersonalizacionService $personalizacionService)
    {
        $this->personalizacionService = new $personalizacionService;
    }

    public function index(): JsonResponse
    {
        try {
            $data = $this->personalizacionService->obtenerPersonalizaciones();

            return response()->json(['data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener personalizaciones',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(RequestPersonalizacion $request): JsonResponse
    {
        try {
            $data = $this->personalizacionService->crearPersonalizacion($request->validated());

            return response()->json([
                'message' => 'Personalización creada exitosamente',
                'data' => $data,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al crear la personalización',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(string $id): JsonResponse
    {
        try {
            $data = $this->personalizacionService->obtenerPersonalizacionPorId((int) $id);

            if (! $data) {
                return response()->json(['error' => 'Personalización no encontrada'], 404);
            }

            return response()->json(['data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener la personalización',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(RequestPersonalizacion $request, string $id): JsonResponse
    {
        try {
            $data = $this->personalizacionService->actualizarPersonalizacion($id, $request->validated());

            if (! $data) {
                return response()->json(['error' => 'Personalización no encontrada'], 404);
            }

            return response()->json([
                'message' => 'Personalización actualizada exitosamente',
                'data' => $data,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al actualizar la personalización',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            $eliminado = $this->personalizacionService->eliminarPersonalizacion((int) $id);

            if (! $eliminado) {
                return response()->json(['error' => 'Personalización no encontrada'], 404);
            }

            return response()->json(['message' => 'Personalización eliminada exitosamente'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al eliminar la personalización',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function restore(string $id): JsonResponse
    {
        try {
            $restaurado = $this->personalizacionService->restaurarPersonalizacion((int) $id);

            if (! $restaurado) {
                return response()->json(['error' => 'Personalización no encontrada o no está eliminada'], 404);
            }

            return response()->json(['message' => 'Personalización restaurada exitosamente'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al restaurar la personalización',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
