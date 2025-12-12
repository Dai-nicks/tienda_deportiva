<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // Create a test user and admin (admin via seeder)
        User::factory()->create([
            'nombre' => 'Test',
            'apellido' => 'User',
            'documento' => '111111111',
            'correo' => 'test@example.com',
            'contrasena' => \Illuminate\Support\Facades\Hash::make('password'),
            'rol' => 'cliente',
        ]);

        $this->call([AdminUserSeeder::class]);
    }
}
