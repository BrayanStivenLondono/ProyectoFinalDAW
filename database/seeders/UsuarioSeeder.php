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
            'nombre_usuario' => 'admin',
            'nombre' => 'Administrador',
            'apellido' => 'Principal',
            'correo' => 'admin@galeriavirtual.com',
            'contrasena' => Hash::make('123456'),
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

        Usuario::create([
            "nombre_usuario" => "brayan27",
            "nombre" => "Brayan",
            "apellido" => "Londoño",
            "correo" => "brayanlondono227@gmail.com",
            "contrasena" => Hash::make("123456"),
            "tipo" => "artista",
            "fecha_registro" => now(),
            "correo_verified_at" => now(),
            'remember_token' => Str::random(10),
            'imagen_perfil' => 'imagenes/logo-ico.ico',
            'biografia' => 'Apasionado artista especializado en paisajes naturales.
                            Apasionado artista especializado en paisajes naturales. Apasionado artista especializado en paisajes naturales.
                            Apasionado artista especializado en paisajes naturales.Apasionado artista especializado en paisajes naturales.',
            'enlaces_sociales' => 'https://instagram.com/brayanlondono',
            'created_at' => now(),
            'updated_at' => now(),

        ]);

        $artistas = [
            ['nombre' => 'Rembrandt', 'apellido' => 'van Rijn'],
            ['nombre' => 'Vincent', 'apellido' => 'van Gogh'],
            ['nombre' => 'Johannes', 'apellido' => 'Vermeer'],
            ['nombre' => 'Hieronymus', 'apellido' => 'Bosch'],
            ['nombre' => 'Frans', 'apellido' => 'Hals'],
            ['nombre' => 'Pieter', 'apellido' => 'Bruegel'],
            ['nombre' => 'Judith', 'apellido' => 'Leyster'],
            ['nombre' => 'Rachel', 'apellido' => 'Ruysch'],
            ['nombre' => 'Willem', 'apellido' => 'Kalf'],
            ['nombre' => 'Jacob', 'apellido' => 'van Ruisdael'],
        ];

        foreach ($artistas as $index => $artista) {
            $username = strtolower($artista['nombre']) . rand(100, 999);

            Usuario::create([
                'nombre_usuario' => $username,
                'nombre' => $artista['nombre'],
                'apellido' => $artista['apellido'],
                'correo' => $username . '@gmail.com',
                'correo_verified_at' => now(),
                'contrasena' => Hash::make('123456'),
                'remember_token' => Str::random(10),
                'tipo' => 'artista',
                'biografia' => 'Artista holandés reconocido por su aporte al arte europeo.',
                'enlaces_sociales' => json_encode([
                    'instagram' => 'https://instagram.com/' . $username,
                    'twitter' => 'https://twitter.com/' . $username,
                ]),
                'imagen_perfil' => 'imagenes/user_prueba.jpg',
                'fecha_registro' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        for ($i = 1; $i <= 5; $i++) {
            Usuario::create([
                'nombre_usuario' => 'user' . $i,
                'nombre' => 'Usuario' . $i,
                'apellido' => 'Visitante',
                'correo' => 'user' . $i . '@gmail.com',
                'contrasena' => Hash::make('123456'),
                'tipo' => 'visitante',
                'fecha_registro' => now(),
                'correo_verified_at' => now(),
                'remember_token' => Str::random(10),
                'imagen_perfil' => 'imagenes/user_default.jpg',
                'biografia' => 'Amante del arte y visitante frecuente de la galería virtual.',
                'enlaces_sociales' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
