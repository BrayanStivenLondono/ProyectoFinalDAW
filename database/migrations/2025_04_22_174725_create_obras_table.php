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
        Schema::create('obras', function (Blueprint $table) {
            $table->id();
            $table->foreignId("id_artista")->constrained("usuarios")->onDelete("cascade");
            $table->string("titulo");
            $table->string("estilo")->nullable();
            $table->string("tecnica")->nullable();
            $table->integer("año_creacion")->nullable();
            $table->text("descripcion")->nullable();
            $table->string("imagen")->nullable();
            $table->text("metadatos_seo")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obras');
    }
};
