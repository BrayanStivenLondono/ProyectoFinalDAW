<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artista>
 */
class ArtistaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Crear un nuevo usuario y asegurarse de que sea artista
        $usuarioArtista = Usuario::factory()->create(['tipo' => 'artista']);

        return [
            "id_artista" => $usuarioArtista->id,
            "declaracion_artista" => $this->faker->paragraph(3),
            "estilo" => $this->faker->word(),
            "tecnica" => $this->faker->words(2, true),
            "created_at" => now(),
            "updated_at" => now(),
        ];
    }
}
