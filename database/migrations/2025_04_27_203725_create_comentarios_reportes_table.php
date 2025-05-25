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
        Schema::create('comentarios_reportes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('comentario_id'); // comentario reportado
            $table->unsignedBigInteger('usuario_id'); // quien reporta
            $table->text('razon')->nullable(); // opcional: motivo del reporte
            $table->timestamps();

            $table->foreign('comentario_id')->references('id')->on('comentarios')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios_reportes');
    }
};
