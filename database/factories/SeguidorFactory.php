<?php

namespace Database\Factories;

use App\Models\Seguidor;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seguidor>
 */
class SeguidorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $seguidor = Usuario::inRandomOrder()->first() ?? Usuario::factory()->create();
        $seguido = Usuario::where('id', '!=', $seguidor->id)->inRandomOrder()->first() ?? Usuario::factory()->create();

        return [
            'id_seguidor' => $seguidor->id,
            'id_seguido' => $seguido->id,
            'fecha_seguimiento' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
