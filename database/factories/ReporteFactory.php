<?php

namespace Database\Factories;

use App\Models\Comentario;
use App\Models\Obra;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reporte>
 */
class ReporteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $usuario = Usuario::inRandomOrder()->first() ?? Usuario::factory()->create();
        $reportable = $this->faker->randomElement([
            function () {
                $obra = Obra::inRandomOrder()->first() ?? Obra::factory()->create();
                return ['id_obra' => $obra->id, 'id_comentario' => null];
            },
            function () {
                $comentario = Comentario::inRandomOrder()->first() ?? Comentario::factory()->create();
                return ['id_obra' => null, 'id_comentario' => $comentario->id];
            },
        ]);
        return [
            "id_usuario" => $usuario->id,
            "id_obra" => $reportable["id_obra"],
            "id_comentario" => $reportable["id_comentario"],
            "motivo" => $this->faker->sentence(),
            "descripcion" => $this->faker->optional()->paragraph(),
            "fecha_reporte" => now(),
            "created_at" => now(),
            "updated_at" => now(),
        ];
    }
}
