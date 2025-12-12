<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validamos los campos (usamos 'correo' y 'contrasena')
        $request->validate([
            'correo' => 'required|email',
            'contrasena' => 'required'
        ]);

        // Buscar usuario por correo
        $user = User::where('correo', $request->correo)->first();

        if (! $user || ! Hash::check($request->contrasena, $user->contrasena)) {
            return response()->json(['message' => 'Credenciales incorrectas'], 401);
        }

        // Generar token (Sanctum)
        $token = $user->createToken('api-token')->plainTextToken;

        $user->makeHidden(['contrasena']);

        return response()->json([
            'message' => 'Login exitoso',
            'usuario' => $user,
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        if ($user && $request->user()->currentAccessToken()) {
            $request->user()->currentAccessToken()->delete();
        }

        return response()->json(['message' => 'Sesión cerrada'], 200);
    }

    public function user(Request $request)
    {
        $user = $request->user();
        if ($user) {
            $user->makeHidden(['contrasena']);
            return response()->json(['usuario' => $user]);
        }

        return response()->json(['message' => 'No autenticado'], 401);
    }

}
