<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Add non-accented columns if they don't exist, migrate values and drop legacy accented columns
        if (! Schema::hasColumn('tblUsuarios', 'telefono')) {
            Schema::table('tblUsuarios', function (Blueprint $table) {
                $table->string('telefono', 20)->nullable();
            });
        }

        if (! Schema::hasColumn('tblUsuarios', 'direccion')) {
            Schema::table('tblUsuarios', function (Blueprint $table) {
                $table->string('direccion', 255)->nullable();
            });
        }

        // Migrate data from legacy columns if present
        $users = DB::table('tblUsuarios')->get();
        foreach ($users as $u) {
            $telefono = null;
            $direccion = null;
            if (isset($u->{'teléfono'})) {
                $telefono = $u->{'teléfono'};
            }
            if (isset($u->{'dirección'})) {
                $direccion = $u->{'dirección'};
            }

            $data = [];
            if (! empty($telefono)) $data['telefono'] = $telefono;
            if (! empty($direccion)) $data['direccion'] = $direccion;

            if (! empty($data)) {
                DB::table('tblUsuarios')->where('id_usuario', $u->id_usuario)->update($data);
            }
        }

        // Drop legacy columns if they exist
        if (Schema::hasColumn('tblUsuarios', 'teléfono')) {
            Schema::table('tblUsuarios', function (Blueprint $table) {
                $table->dropColumn('teléfono');
            });
        }
        if (Schema::hasColumn('tblUsuarios', 'dirección')) {
            Schema::table('tblUsuarios', function (Blueprint $table) {
                $table->dropColumn('dirección');
            });
        }

        // Make new columns not nullable (if you prefer)
        if (Schema::hasColumn('tblUsuarios', 'telefono')) {
            Schema::table('tblUsuarios', function (Blueprint $table) {
                $table->string('telefono', 20)->nullable()->change();
            });
        }
        if (Schema::hasColumn('tblUsuarios', 'direccion')) {
            Schema::table('tblUsuarios', function (Blueprint $table) {
                $table->string('direccion', 255)->nullable()->change();
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasColumn('tblUsuarios', 'teléfono')) {
            Schema::table('tblUsuarios', function (Blueprint $table) {
                $table->string('teléfono', 20)->nullable();
            });
        }
        if (! Schema::hasColumn('tblUsuarios', 'dirección')) {
            Schema::table('tblUsuarios', function (Blueprint $table) {
                $table->string('dirección', 255)->nullable();
            });
        }

        $users = DB::table('tblUsuarios')->get();
        foreach ($users as $u) {
            $data = [];
            if (isset($u->telefono)) $data['teléfono'] = $u->telefono;
            if (isset($u->direccion)) $data['dirección'] = $u->direccion;
            if (! empty($data)) {
                DB::table('tblUsuarios')->where('id_usuario', $u->id_usuario)->update($data);
            }
        }

        if (Schema::hasColumn('tblUsuarios', 'telefono')) {
            Schema::table('tblUsuarios', function (Blueprint $table) {
                $table->dropColumn('telefono');
            });
        }
        if (Schema::hasColumn('tblUsuarios', 'direccion')) {
            Schema::table('tblUsuarios', function (Blueprint $table) {
                $table->dropColumn('direccion');
            });
        }
    }
};
