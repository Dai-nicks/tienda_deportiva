<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $email = 'admin@local.dev';
        $pwKey = Schema::hasColumn('tblUsuarios', 'contrasena') ? 'contrasena' : (Schema::hasColumn('tblUsuarios', 'contraseña') ? 'contraseña' : 'contrasena');

        DB::table('tblUsuarios')->updateOrInsert(
            ['correo' => $email],
            array_merge([
                'nombre' => 'Admin',
                'apellido' => 'Principal',
                'documento' => '000000000',
                'rol' => 'admin',
                'estado' => 1,
                'fecha_nacimiento' => '1990-01-01',
            ], [ $pwKey => Hash::make('admin123') ])
        );
    }
}
