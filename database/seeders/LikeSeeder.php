<?php

namespace Database\Seeders;

use App\Models\Like;
use App\Models\Obra;
use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usuarios = Usuario::all();
        $obras = Obra::all();

        // Dar "likes" aleatorios
        foreach ($obras as $obra) {
            // Seleccionar un número aleatorio de usuarios que den like a esta obra
            $usuariosQueDieronLike = $usuarios->random(rand(1, 5)); // 1 a 5 usuarios por obra

            foreach ($usuariosQueDieronLike as $usuario) {
                // Crear el registro en la tabla `likes`
                Like::create([
                    'id_usuario' => $usuario->id,
                    'id_obra' => $obra->id,
                ]);
            }
        }
    }
}
