<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestUsuario;
use App\Services\UsuarioService;
use Illuminate\Http\JsonResponse;

class UsuarioController extends Controller
{
   protected UsuarioService $usuarioService;

   public function __construct()
   {
        $this->usuarioService = new UsuarioService();
   }

    public function index(): JsonResponse
    {
        try {
            $usuarios = $this->usuarioService->obtenerUsuarios();

            return response()->json(['data' => $usuarios], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener usuarios', 'message' => $e->getMessage()], 500);
        }
    }

    public function store(RequestUsuario $request): JsonResponse
    {
        try {
            $usuario = $this->usuarioService->crearUsuario($request->validated());

            return response()->json(['message' => 'Usuario creado exitosamente', 'data' => $usuario], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear el usuario', 'message' => $e->getMessage()], 500);
        }
    }

    public function show(string $id): JsonResponse
    {
        try {
            $usuario = $this->usuarioService->obtenerUsuarioPorId((int) $id);
            if (! $usuario) {
                return response()->json(['error' => 'Usuario no encontrado'], 404);
            }

            return response()->json(['data' => $usuario], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener el usuario', 'message' => $e->getMessage()], 500);
        }
    }

    public function update(RequestUsuario $request, string $id): JsonResponse
    {
        try {
            $usuario = $this->usuarioService->actualizarUsuario($id, $request->validated());
            if (! $usuario) {
                return response()->json(['error' => 'Usuario no encontrado'], 404);
            }

            return response()->json(['message' => 'Usuario actualizado exitosamente', 'data' => $usuario], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el usuario', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $eliminado = $this->usuarioService->eliminarUsuario((int) $id);
            if (! $eliminado) {
                return response()->json(['error' => 'Usuario no encontrado'], 404);
            }

            return response()->json(['message' => 'Usuario eliminado exitosamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar el usuario', 'message' => $e->getMessage()], 500);
        }
    }

    public function restore(string $id): JsonResponse
    {
        try {
            $restaurado = $this->usuarioService->restaurarUsuario((int) $id);
            if (! $restaurado) {
                return response()->json(['error' => 'Usuario no encontrado o no eliminado'], 404);
            }

            return response()->json(['message' => 'Usuario restaurado exitosamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al restaurar el usuario', 'message' => $e->getMessage()], 500);
        }
    }
}
