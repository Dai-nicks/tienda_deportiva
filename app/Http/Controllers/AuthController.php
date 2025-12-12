<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'contraseña' => 'required'
        ]);

        $usuario = Usuario::where('correo', $request->correo)->first();

        if (!$usuario) {
            return response()->json(['message' => 'Correo no registrado'], 404);
        }

        if (!Hash::check($request->contraseña, $usuario->contraseña)) {
            return response()->json(['message' => 'Contraseña incorrecta'], 401);
        }

        $token = $usuario->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'Login exitoso',
            'usuario' => $usuario,
            'token' => $token
        ]);
    }
}
 