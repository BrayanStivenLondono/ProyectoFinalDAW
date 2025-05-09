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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string("nombre_usuario")->unique();
            $table->string("nombre")->unique();
            $table->string("apellido")->nullable();
            $table->string("correo")->unique();
            $table->string("contrasena");
            $table->timestamp("fecha_registro")->useCurrent();
            $table->timestamp('correo_verified_at')->nullable();
            $table->enum("tipo", ["artista","visitante", "administrador"]);
            $table->text("biografia")->nullable();
            $table->text("enlaces_sociales")->nullable();
            $table->string("imagen_perfil");
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
