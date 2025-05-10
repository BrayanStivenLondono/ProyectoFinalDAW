<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Obra>
 */
class ObraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Obtenemos un usuario aleatorio para asignarle la obra
        $artista = Usuario::where('tipo', 'artista')->inRandomOrder()->first();

        return [
            "id_artista" => $artista ? $artista->id : 1, // Si no hay artista, asignamos un id por defecto
            "titulo" => implode(' ', $this->faker->words(2)),
            "estilo" => $this->faker->optional()->word(),
            "tecnica" => $this->faker->optional()->word(),
            "tipo" => $this->faker->word(),
            "año_creacion" => $this->faker->optional()->year(),
            "descripcion" => $this->faker->optional()->paragraph(4),
            "imagen" => "imagenes/obra_default.png",
            "metadatos_seo" => $this->faker->optional()->sentence(5),
            "created_at" => now(),
            "updated_at" => now(),
        ];
    }
}
