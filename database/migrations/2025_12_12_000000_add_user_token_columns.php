<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tblUsuarios', function (Blueprint $table) {
            if (!Schema::hasColumn('tblUsuarios', 'remember_token')) {
                $table->string('remember_token', 100)->nullable()->after('fecha_nacimiento');
            }
            if (!Schema::hasColumn('tblUsuarios', 'email_verified_at')) {
                $table->timestamp('email_verified_at')->nullable()->after('remember_token');
            }
        });
    }

    public function down(): void
    {
        Schema::table('tblUsuarios', function (Blueprint $table) {
            if (Schema::hasColumn('tblUsuarios', 'remember_token')) {
                $table->dropColumn('remember_token');
            }
            if (Schema::hasColumn('tblUsuarios', 'email_verified_at')) {
                $table->dropColumn('email_verified_at');
            }
        });
    }
};
