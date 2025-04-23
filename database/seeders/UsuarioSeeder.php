<?php

namespace Database\Seeders;

use App\Models\Usuario; // ¡Corregido el nombre del modelo!
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear un usuario administrador
        Usuario::create([
            'nombre_usuario' => 'admin_galeria',
            'nombre' => 'Administrador',
            'apellido' => 'Principal',
            'correo' => 'admin@galeriavirtual.com',
            'contrasena' => Hash::make('12345'),
            'tipo' => 'administrador',
            'fecha_registro' => now(),
            'correo_verified_at' => now(),
            'remember_token' => Str::random(10),
            'imagen_perfil' => 'imagenes/user_default.jpg',
            'biografia' => 'Administrador del sitio web de la galería virtual.',
            'enlaces_sociales' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Crear algunos usuarios artistas usando el factory
        Usuario::factory()->count(5)->create(['tipo' => 'artista']);

        // Crear algunos usuarios visitantes usando el factory
        Usuario::factory()->count(5)->create(['tipo' => 'visitante']);

        // Crear un artista específico con datos concretos
        Usuario::create([
            'nombre_usuario' => 'artista_ejemplo',
            'nombre' => 'Elena',
            'apellido' => 'Pintora',
            'correo' => 'elena.pintora@arte.com',
            'contrasena' => Hash::make('12345'),
            'tipo' => 'artista',
            'fecha_registro' => now(),
            'correo_verified_at' => now(),
            'remember_token' => Str::random(10),
            'imagen_perfil' => 'imagenes/user_default.jpg',
            'biografia' => 'Apasionada artista especializada en paisajes urbanos.',
            'enlaces_sociales' => 'https://instagram.com/elenapintora',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Usuario::create([
            "nombre_usuario" => "Brayan27",
            "nombre" => "Brayan",
            "apellido" => "Londoño",
            "correo" => "brayanlondono227@gmail.com",
            "contrasena" => Hash::make("12345"),
            "tipo" => "administrador",
            "fecha_registro" => now(),
            "correo_verified_at" => now(),
            'remember_token' => Str::random(10),
            'imagen_perfil' => 'imagenes/user_default.jpg',
            'biografia' => 'Apasionado artista especializado en paisajes naturales.',
            'enlaces_sociales' => 'https://instagram.com/brayanlondono',
            'created_at' => now(),
            'updated_at' => now(),

        ]);

        // Puedes añadir más usuarios artistas o visitantes según necesites
    }
}
