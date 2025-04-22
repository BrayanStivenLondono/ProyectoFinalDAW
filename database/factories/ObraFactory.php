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
        $artista = Usuario::where('tipo_usuario', 'artista')->inRandomOrder()->first() ?? Usuario::factory()->create(['tipo_usuario' => 'artista']);

        return [
           "id_artista" => $artista->id,
           "titulo" => $this->faker->sentence(2),
           "estilo" => $this->faker->optional()->word(),
            "tecnica" => $this->faker->optional()->word(),
            "año_creacion" => $this->faker->optional()->year(),
            "descripcion" => $this->faker->optional()->paragraph(4),
            "imagen" => $this->faker->optional()->imageUrl(640, 480, "art", true),
            "metadato_seo" => $this->faker->optional()->sentence(5),
            "created_at" => now(),
            "updated_at" => now(),

        ];
    }
}
