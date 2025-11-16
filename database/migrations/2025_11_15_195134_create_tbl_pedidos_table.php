<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tblPedidos', function (Blueprint $table) {
            $table->id('id_pedido');
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_pago')->nullable();
            $table->timestamp('fecha_pedido')->useCurrent();
            $table->decimal('total', 10, 2);
            $table->string('estado', 50);//en caso de poner las variables de estado poner *enum* y sus variables y el default
            $table->string('direccion_envio', 255);
            $table->string('metodo_pago', 100);
            $table->softDeletes();

            

            $table->foreign('id_usuario')->references('id_usuario')->on('tblUsuarios')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tblPedidos');
    }
};
