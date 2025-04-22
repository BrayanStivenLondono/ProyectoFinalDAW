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
        Schema::create('reportes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usuario'); // usuario que reporta
            $table->unsignedBigInteger('id_obra')->nullable(); // obra reportada
            $table->unsignedBigInteger('id_comentario')->nullable(); // comentario reportado
            $table->text('motivo');
            $table->text('descripcion')->nullable();
            $table->timestamp('fecha_reporte')->useCurrent();

            // Relaciones
            $table->foreign('id_usuario')
                ->references('id')
                ->on('usuarios')
                ->onDelete('cascade');

            $table->foreign('id_obra')
                ->references('id')
                ->on('obras')
                ->onDelete('cascade');

            $table->foreign('id_comentario')
                ->references('id')
                ->on('comentarios')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportes');
    }
};
