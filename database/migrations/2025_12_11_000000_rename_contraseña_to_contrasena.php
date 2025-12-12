<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasColumn('tblUsuarios', 'contrasena')) {
            Schema::table('tblUsuarios', function (Blueprint $table) {
                // add new column contrasena
                $table->string('contrasena', 255)->nullable();
            });
        }

        // migrate values from 'contraseña' to 'contrasena'
        $users = DB::table('tblUsuarios')->get();
        foreach ($users as $u) {
            $pw = $u->{'contraseña'} ?? '';
            // if not bcrypt/argon then hash
            if (!preg_match('/^\$2[ayb]\$|^\$argon/iu', $pw)) {
                $pw = Hash::make($pw);
            }
            DB::table('tblUsuarios')
                ->where('id_usuario', $u->id_usuario)
                ->update(['contrasena' => $pw]);
        }

        if (Schema::hasColumn('tblUsuarios', 'contraseña')) {
            Schema::table('tblUsuarios', function (Blueprint $table) {
                $table->dropColumn('contraseña');
            });
        }
        if (Schema::hasColumn('tblUsuarios', 'contrasena')) {
            Schema::table('tblUsuarios', function (Blueprint $table) {
                $table->string('contrasena', 255)->nullable(false)->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasColumn('tblUsuarios', 'contraseña')) {
            Schema::table('tblUsuarios', function (Blueprint $table) {
                $table->string('contraseña', 255)->nullable();
            });
        }

        $users = DB::table('tblUsuarios')->get();
        foreach ($users as $u) {
            $pw = $u->contrasena ?? '';
            // copy back without modification
            DB::table('tblUsuarios')
                ->where('id_usuario', $u->id_usuario)
                ->update(['contraseña' => $pw]);
        }

        if (Schema::hasColumn('tblUsuarios', 'contrasena')) {
            Schema::table('tblUsuarios', function (Blueprint $table) {
                $table->dropColumn('contrasena');
            });
        }
        if (Schema::hasColumn('tblUsuarios', 'contraseña')) {
            Schema::table('tblUsuarios', function (Blueprint $table) {
                $table->string('contraseña', 255)->nullable(false)->change();
            });
        }
    }
};
