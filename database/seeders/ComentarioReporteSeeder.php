<?php

namespace Database\Seeders;

use App\Models\Comentario;
use App\Models\ComentarioReporte;
use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComentarioReporteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comentarios = Comentario::all();
        $usuarios = Usuario::all();

        if ($comentarios->isEmpty() || $usuarios->isEmpty()) {
            $this->command->warn("Debes tener comentarios y usuarios creados antes de ejecutar este seeder.");
            return;
        }

        $razones = [
            "Lenguaje ofensivo o insultos.",
            "Contenido inapropiado o spam.",
            "El comentario no tiene relación con la obra.",
            "Posible plagio o violación de derechos.",
            "Contenido político o religioso no solicitado.",
            "Incitación al odio o discriminación.",
            "Publicidad no autorizada."
        ];

        foreach (range(1, 20) as $i) {
            ComentarioReporte::create([
                'comentario_id' => $comentarios->random()->id,
                'usuario_id' => $usuarios->random()->id,
                'razon' => $razones[array_rand($razones)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
