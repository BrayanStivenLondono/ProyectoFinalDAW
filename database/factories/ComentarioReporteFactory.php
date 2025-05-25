<?php

namespace Database\Factories;

use App\Models\Comentario;
use App\Models\ComentarioReporte;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ComentarioReporte>
 */
class ComentarioReporteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ComentarioReporte::class;

    public function definition()

    {
        return [
            'comentario_id' => Comentario::factory(), // crea o usa un comentario
            'usuario_id' => Usuario::factory(),       // crea o usa un usuario
            'razon' => $this->faker->sentence(6),    // texto aleatorio para la razón
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
