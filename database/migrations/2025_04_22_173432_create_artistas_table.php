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
        Schema::create('artistas', function (Blueprint $table) {
            $table->foreignId("id_artista")->constrained("usuarios")->onDelete("cascade");
            $table->text("declaracion_artista")->nullable();
            $table->string("estilo")->nullable();
            $table->string("tecnica")->nullable();
            $table->timestamps();
            $table->primary("id_artista");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artistas');
    }
};
