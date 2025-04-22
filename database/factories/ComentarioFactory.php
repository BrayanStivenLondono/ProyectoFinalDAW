<?php

namespace Database\Factories;

use App\Models\Obra;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comentario>
 */
class ComentarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Obtener un usuario existente o crear uno nuevo
        $usuario = Usuario::inRandomOrder()->first() ?? Usuario::factory()->create();

        // Obtener una obra existente o crear una nueva
        $obra = Obra::inRandomOrder()->first() ?? Obra::factory()->create();

        return [
            "id_usuario" => $usuario->id,
            "id_obra" => $obra->id,
            "contenido" => $this->faker->paragraph(),
            "fecha_comentario" => now(),
            "created_at" => now(),
            "updated_at" => now(),
        ];
    }
}
