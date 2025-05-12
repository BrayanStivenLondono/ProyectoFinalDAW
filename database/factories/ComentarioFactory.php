<?php

namespace Database\Factories;

use App\Models\Comentario;
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
        $comentarioPadre = Comentario::inRandomOrder()->first();

        // Obtenemos un usuario al azar, o creamos uno nuevo si no se encuentra
        $usuario = Usuario::inRandomOrder()->first() ?? Usuario::factory()->create();

        // Obtenemos una obra al azar, o creamos una nueva si no se encuentra
        $obra = Obra::inRandomOrder()->first() ?? Obra::factory()->create();

        return [
            "id_usuario" => $usuario->id,
            "id_obra" => $obra->id,
            "contenido" => $this->faker->paragraph(),
            "fecha_comentario" => now(),
            'id_comentario_respuesta' => $comentarioPadre ? $comentarioPadre->id : null,
            "created_at" => now(),
            "updated_at" => now(),
        ];
    }
}
