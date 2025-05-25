<?php

namespace Database\Seeders;

use App\Models\Comentario;
use App\Models\Obra;
use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComentarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usuarios = Usuario::all();
        $obras = Obra::all();

        if ($usuarios->isEmpty() || $obras->isEmpty()) {
            $this->command->warn("Debes tener usuarios y obras creados antes de ejecutar este seeder.");
            return;
        }

        $comentariosBase = [
            "Esta obra tiene una profundidad emocional increíble.",
            "Me recuerda a los paisajes de Monet.",
            "¡Qué técnica tan impresionante!",
            "¿Qué materiales usaste para esta pieza?",
            "Realmente captura la esencia del movimiento.",
            "Me encantan los detalles en blanco y negro.",
            "Este estilo abstracto me fascina.",
            "El mensaje detrás de esta obra es muy potente.",
            "¡Arte digital en su máxima expresión!",
            "Excelente composición y uso del color.",
        ];

        $comentariosCreados = [];

        // Comentarios base
        foreach ($comentariosBase as $contenido) {
            $comentariosCreados[] = Comentario::create([
                'id_usuario' => $usuarios->random()->id,
                'id_obra' => $obras->random()->id,
                'contenido' => $contenido,
                'fecha_comentario' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Comentarios respuesta
        $respuestas = [
            "Totalmente de acuerdo contigo.",
            "¡Gracias por tu comentario!",
            "Eso mismo pensé al verla.",
            "Buena observación, no lo había notado.",
            "Me alegra que te guste.",
        ];

        foreach ($respuestas as $respuesta) {
            $comentarioPadre = collect($comentariosCreados)->random();
            Comentario::create([
                'id_usuario' => $usuarios->random()->id,
                'id_obra' => $comentarioPadre->id_obra,
                'contenido' => $respuesta,
                'fecha_comentario' => now(),
                'id_comentario_respuesta' => $comentarioPadre->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
