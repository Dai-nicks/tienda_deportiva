<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tblPersonalizacion', function (Blueprint $table) {
            $table->id('id_personalizacion');
            $table->unsignedBigInteger('id_producto');
            $table->unsignedBigInteger('id_usuario');
            $table->string('tipo_perzonalizacion', 100);
            $table->string('talla', 50);
            $table->float('precio_total_personalizacion');
            $table->text('diseño')->nullable();
            $table->softDeletes();

            $table->foreign('id_producto')->references('id_producto')->on('tblProductos')->onDelete('restrict');

            $table->foreign('id_usuario')->references('id_usuario')->on('tblUsuarios')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tblPersonalizacion');
    }
};
