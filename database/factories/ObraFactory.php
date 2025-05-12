<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

class ObraFactory extends Factory
{
    public function definition(): array
    {
        $usuario = Usuario::where('tipo', 'artista')->inRandomOrder()->first();

        return [
            "id_artista" => $usuario ? $usuario->id : 1,
            "titulo" => implode(' ', $this->faker->words(2)),
            "estilo" => $this->faker->word(),
            "tecnica" => $this->faker->word(),
            "tipo" => $this->faker->word(),
            "año_creacion" => $this->faker->year(),
            "descripcion" => $this->faker->paragraph(7),
            "imagen" => "imagenes/obra_default.png",
            "metadatos_seo" => $this->faker->optional()->sentence(5),
            "created_at" => now(),
            "updated_at" => now(),
        ];
    }
}
