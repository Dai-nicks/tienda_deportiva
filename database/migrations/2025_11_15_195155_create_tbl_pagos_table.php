<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tblPagos', function (Blueprint $table) {
            $table->id('id_pago');
            $table->unsignedBigInteger('id_pedido');
            $table->timestamp('fecha_pago')->useCurrent();
            $table->string('metodo', 50);
            $table->decimal('monto', 10, 2);
            $table->enum('estado',['pendiente', 'procesando', 'aprobado', 'rechazado', 'fallido', 'reembolsado', 'cancelado'])->default('pendiente');
            $table->string('referencia_transaccion', 255)->nullable()->unique();
            $table->softDeletes();

            $table->foreign('id_pedido')->references('id_pedido')->on('tblPedidos')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tblPagos');
    }
};
