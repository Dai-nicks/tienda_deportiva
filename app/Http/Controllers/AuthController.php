<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Normalizar campo por compatibilidad: preferimos `contrasena` (sin ñ)
        if ($request->has('contraseña') && !$request->has('contrasena')) {
            $request->merge(['contrasena' => $request->{'contraseña'}]);
        }

        $request->validate([
            'correo' => 'required|email',
            'contrasena' => 'required'
        ]);

        $usuario = Usuario::where('correo', $request->correo)->first();

        if (!$usuario) {
            return response()->json(['message' => 'Correo no registrado'], 404);
        }

        try {
            $passwordMatches = Hash::check($request->contrasena, $usuario->contrasena);
        } catch (\RuntimeException $e) {
            // Si la contraseña no está en formato bcrypt, intentamos igualar en texto plano (migración)
            if ($usuario->contrasena === $request->contrasena) {
                // Re-hash y actualizar
                $usuario->contrasena = Hash::make($request->contrasena);
                $usuario->save();
                $passwordMatches = true;
            } else {
                $passwordMatches = false;
            }
        }

        if (! $passwordMatches) {
            return response()->json(['message' => 'Contraseña incorrecta'], 401);
        }

        // Use the Authenticatable User model (which uses HasApiTokens) to create the token
        $userForToken = User::where('correo', $usuario->correo)->first();
        if (! $userForToken) {
            // Fallback: build a temporary User instance from the Usuario attributes
            $userForToken = new User();
            // copy attributes (including id_usuario) so Sanctum has an id to reference
            $userForToken->setRawAttributes($usuario->getAttributes(), true);
            $userForToken->exists = true;
        }

        $token = $userForToken->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'Login exitoso',
            'usuario' => $usuario,
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        if ($user) {
            // Revoke all tokens for this user
            if (method_exists($user, 'tokens')) {
                $user->tokens()->delete();
            }
            // Also try to delete by the bearer token hash (robust deletion)
            $bearer = $request->bearerToken();
            if (! empty($bearer)) {
                $hash = hash('sha256', $bearer);
                DB::table('personal_access_tokens')->where('token', $hash)->delete();
                // Also try to delete by id prefix (token format is {id}|{random})
                if (str_contains($bearer, '|')) {
                    [$idPart, $rest] = explode('|', $bearer, 2);
                    $idInt = intval($idPart);
                    if ($idInt > 0) {
                        DB::table('personal_access_tokens')->where('id', $idInt)->delete();
                    }
                }
            }
            return response()->json(['message' => 'Logout exitoso']);
        }

        return response()->json(['message' => 'No hay token activo'], 400);
    }
}
