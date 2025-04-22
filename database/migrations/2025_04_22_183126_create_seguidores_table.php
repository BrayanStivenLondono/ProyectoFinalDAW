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
        Schema::create('seguidores', function (Blueprint $table) {
            $table->foreignId('id_seguidor')->constrained('usuarios')->onDelete('cascade');
            $table->foreignId('id_seguido')->constrained('usuarios')->onDelete('cascade');
            $table->timestamp('fecha_seguimiento')->useCurrent();
            $table->timestamps();

            $table->primary(['id_seguidor', 'id_seguido']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seguidores');
    }
};
