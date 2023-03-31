<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('informe', function (Blueprint $table) {
            $table->id();
            $table->text('numero');
            $table->text('id_usuario');
            $table->text('usuario');
            $table->text('nombre_dirigido');
            $table->text('cargo');
            $table->text('unidad');
            $table->text('referencia');
            $table->text('tipo_informe');
            $table->text('fecha');
            $table->text('dato_informe');
            $table->text('observacion')->nullable();
            $table->text('estado')->nullable();
            $table->text('id_oficina')->nullable();
            $table->text('oficina')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informe');
    }
};
