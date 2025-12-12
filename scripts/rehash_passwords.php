<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

$users = DB::table('tblUsuarios')->get();
$updated = 0;
foreach ($users as $u) {
    // If password does not start with $2 (bcrypt), rehash it
    $pw = $u->contrasena ?? ($u->{'contraseña'} ?? '');
    if (strpos($pw, '$2') !== 0) {
        $newHash = Hash::make($pw);
        if (Schema::hasColumn('tblUsuarios', 'contrasena')) {
            DB::table('tblUsuarios')->where('id_usuario', $u->id_usuario)->update(['contrasena' => $newHash]);
        } else {
            DB::table('tblUsuarios')->where('id_usuario', $u->id_usuario)->update(['contraseña' => $newHash]);
        }
        $updated++;
    }
}

echo "Rehashed passwords for {$updated} users\n";
