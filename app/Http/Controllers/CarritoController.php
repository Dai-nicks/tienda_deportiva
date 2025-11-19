<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestCarrito;
use App\Services\CarritoService;
use Illuminate\Http\JsonResponse;

class CarritoController extends Controller
{
    protected $carritoService;

    public function __construct(CarritoService $carritoService)
    {
        $this->carritoService = new $carritoService;
    }

    public function index(): JsonResponse
    {
        try {
            $carritos = $this->carritoService->obtenerCarritos();
            return response()->json(['data' => $carritos], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener los carritos',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(RequestCarrito $request): JsonResponse
    {
        try {
            $carrito = $this->carritoService->crearCarrito($request->validated());

            if (! $carrito) {
                return response()->json([
                    'error' => 'El usuario ya tiene un carrito creado'
                ], 409);
            }

            return response()->json([
                'message' => 'Carrito creado exitosamente',
                'data' => $carrito,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al crear el carrito',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(string $id): JsonResponse
    {
        try {
            $carrito = $this->carritoService->obtenerCarritoPorId((int) $id);

            if (! $carrito) {
                return response()->json(['error' => 'Carrito no encontrado'], 404);
            }

            return response()->json(['data' => $carrito], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener el carrito',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(RequestCarrito $request, string $id): JsonResponse
    {
        try {
            $carrito = $this->carritoService->actualizarCarrito($id, $request->validated());

            if (! $carrito) {
                return response()->json(['error' => 'Carrito no encontrado'], 404);
            }

            return response()->json([
                'message' => 'Carrito actualizado exitosamente',
                'data' => $carrito,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al actualizar el carrito',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            $eliminado = $this->carritoService->eliminarCarrito((int) $id);

            if (! $eliminado) {
                return response()->json(['error' => 'Carrito no encontrado'], 404);
            }

            return response()->json(['message' => 'Carrito eliminado exitosamente'], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al eliminar el carrito',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function restore(string $id): JsonResponse
    {
        try {
            $restaurado = $this->carritoService->restaurarCarrito((int) $id);

            if (! $restaurado) {
                return response()->json(['error' => 'Carrito no encontrado o no está eliminado'], 404);
            }

            return response()->json(['message' => 'Carrito restaurado exitosamente'], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al restaurar el carrito',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
