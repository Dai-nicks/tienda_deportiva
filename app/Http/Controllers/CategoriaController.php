<?php

namespace App\Http\Controllers;

use App\Htpp\Request\RequestCategoria;
use App\Services\CategoriaService;
use Illuminate\Http\JsonResponse;

class CategoriaController extends Controller
{
    private CategoriaService $categoriaService;

    public function __construct()
    {
        $this->categoriaService = new CategoriaService;
    }

        public function index(): JsonResponse
    {
        try {

            $categoria = $this->categoriaService->obtenerCategorias();

            return response()->json(['data' => $categoria], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener las categorías', 'message' => $e->getMessage()], 500);
        }

    }

    public function store(RequestCategoria $request): JsonResponse
    {
        try {
            $categoria = $this->categoriaService->crearCategoria($request->validated());

            return response()->json(['message' => 'Categoria creada exitosamente', 'data' => $categoria], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear la categoría', 'message' => $e->getMessage()], 500);
        }

    }

    public function show($id): JsonResponse
    {
        try {
            $categoria = $this->categoriaService->obtenerCategoriaPorId($id);
            if (! $categoria) {
                return response()->json(['message' => 'Categoría no encontrada'], 404);
            }

            return response()->json($categoria, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener la categoría', 'message' => $e->getMessage()], 500);
        }

    }

    public function update(RequestCategoria $request, $id): JsonResponse
    {
        try {
            $categoria = $this->categoriaService->actualizarCategoria($id, $request->validated());
            if (! $categoria) {
                return response()->json(['message' => 'Categoría no encontrada'], 404);
            }

            return response()->json(['message' => 'Categoria actualizada exitosamente', 'data' => $categoria], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar la categoría', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $deleted = $this->categoriaService->eliminarCategoria($id);
            if (! $deleted) {
                return response()->json(['message' => 'Categoría no encontrada'], 404);
            }

            return response()->json(['message' => 'Categoría eliminada correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar la categoría', 'message' => $e->getMessage()], 500);
        }

    }

    public function restore(int $id): JsonResponse
    {
        try {
            $restored = $this->categoriaService->restaurarCategoria($id);
            if (! $restored) {
                return response()->json(['message' => 'Categoría no encontrada o no eliminada'], 404);
            }

            return response()->json(['message' => 'Categoría restaurada correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al restaurar la categoría', 'message' => $e->getMessage()], 500);
        }

    }
}
