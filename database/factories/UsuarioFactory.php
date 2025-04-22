<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "nombre_usuario" => $this->faker->userName(),
            "nombre" => $this->faker->firstName(),
            "apellido" => $this->faker->lastName(),
            "correo_verified_at" => now(),
            "contrasena" => Hash::make("12345"),
            "remember_token" => Str::random(10),
            "tipo" => $this->faker->randomElement(["artista", "visitante", "administrador"]),
            "biografia" => $this->faker->paragraph(),
            "enlaces_sociales" => $this->faker->optional()->url(),
            "imagen_perfil" => "imagenes/user_default.jpg",
            "fecha_registro" => now(),
            "created_at" => now(),
            "updated_at" => now(),
        ];
    }
}
