<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class AuthLoginTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function user_can_login_and_receive_token()
    {
        // Arrange: insert a user directly into DB
        $email = 'testuser@example.com';
        $password = 'testing123';

        DB::table('tblUsuarios')->updateOrInsert(
            ['correo' => $email],
            [
                'nombre' => 'Test',
                'apellido' => 'User',
                'documento' => '9999',
                'contrasena' => Hash::make($password),
                'rol' => 'cliente',
                'estado' => 1,
                'fecha_nacimiento' => '1990-01-01',
            ]
        );

        // Act: call the login endpoint
        $response = $this->postJson('/api/login', ['correo' => $email, 'contrasena' => $password]);

        // Assert
        $response->assertStatus(200);
        $response->assertJsonStructure(['message', 'usuario', 'token']);
    }
}
