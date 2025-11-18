<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestProducto;
use App\Services\ProductoService;
use Illuminate\Http\JsonResponse;

class ProductoController extends Controller
{
    protected $productoService;

    public function __contruct(ProductoService $productoService)
    {
        $this->productoService = new $productoService;
    }

    public function index(): JsonResponse
    {
        try {
            $productos = $this->productoService->obtenerProductos();

            return response()->json(['data' => $productos], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener los productos',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(RequestProducto $request): JsonResponse
    {
        try {
            $producto = $this->productoService->crearProducto($request->validated());

            return response()->json([
                'message' => 'Producto creado exitosamente',
                'data' => $producto,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al crear el producto',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(string $id): JsonResponse
    {
        try {
            $producto = $this->productoService->obtenerProductoPorId((int) $id);

            if (! $producto) {
                return response()->json(['error' => 'Producto no encontrado'], 404);
            }

            return response()->json(['data' => $producto], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener el producto',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(RequestProducto $request, string $id): JsonResponse
    {
        try {
            $producto = $this->productoService->actualizarProducto($id, $request->validated());

            if (! $producto) {
                return response()->json(['error' => 'Producto no encontrado'], 404);
            }

            return response()->json([
                'message' => 'Producto actualizado exitosamente',
                'data' => $producto,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al actualizar el producto',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            $eliminado = $this->productoService->eliminarProducto((int) $id);

            if (! $eliminado) {
                return response()->json(['error' => 'Producto no encontrado'], 404);
            }

            return response()->json(['message' => 'Producto eliminado exitosamente'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al eliminar el producto',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function restore(string $id): JsonResponse
    {
        try {
            $restaurado = $this->productoService->restaurarProducto((int) $id);

            if (! $restaurado) {
                return response()->json(['error' => 'Producto no encontrado o no está eliminado'], 404);
            }

            return response()->json(['message' => 'Producto restaurado exitosamente'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al restaurar el producto',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
