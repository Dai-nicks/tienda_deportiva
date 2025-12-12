<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthUnauthorizedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function protected_endpoints_return_401_without_token()
    {
        $response = $this->getJson('/api/usuarios');
        $response->assertStatus(401);
    }
}
