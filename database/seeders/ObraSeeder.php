<?php

namespace Database\Seeders;

use App\Models\Obra;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ObraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Obra::create([
            'id_artista' => 1,
            'titulo' => 'Atardecer en la Albufera',
            'estilo' => 'Impresionismo',
            'tecnica' => 'Óleo sobre lienzo',
            'tipo' => 'Clasico',
            'año_creacion' => 2021,
            'descripcion' => 'Una escena serena al atardecer en el humedal valenciano, con reflejos dorados sobre el agua.
                            Una escena serena al atardecer en el humedal valenciano, con reflejos dorados sobre el agua.
                            Una escena serena al atardecer en el humedal valenciano, con reflejos dorados sobre el agua.
                            Una escena serena al atardecer en el humedal valenciano, con reflejos dorados sobre el agua.
                            Una escena serena al atardecer en el humedal valenciano, con reflejos dorados sobre el agua.
                            Una escena serena al atardecer en el humedal valenciano, con reflejos dorados sobre el agua.',
            'imagen' => 'imagenes/obra1.jpg',
            'metadatos_seo' => 'obra impresionista, paisaje al atardecer, óleo valenciano',
        ]);

        Obra::create([
            'id_artista' => 2,
            'titulo' => 'Geometría Urbana',
            'estilo' => 'Abstracto',
            'tecnica' => 'Acrílico sobre madera',
            'tipo' => 'Clasico',
            'año_creacion' => 2023,
            'descripcion' => 'Composición abstracta basada en las líneas y formas de la arquitectura urbana moderna.
                            Composición abstracta basada en las líneas y formas de la arquitectura urbana moderna.
                            Composición abstracta basada en las líneas y formas de la arquitectura urbana moderna.
                            Composición abstracta basada en las líneas y formas de la arquitectura urbana moderna.
                            Composición abstracta basada en las líneas y formas de la arquitectura urbana moderna.
                            Composición abstracta basada en las líneas y formas de la arquitectura urbana moderna.
                            Composición abstracta basada en las líneas y formas de la arquitectura urbana moderna.',
            'imagen' => 'imagenes/obra2.jpg',
            'metadatos_seo' => 'arte abstracto, formas geométricas, acrílico moderno',
        ]);

        Obra::create([
            'id_artista' => 3,
            'titulo' => 'Raíces Flamencas',
            'estilo' => 'Realismo',
            'tecnica' => 'Carboncillo sobre papel',
            'tipo' => 'Moderno',
            'año_creacion' => 2022,
            'descripcion' => 'Retrato expresivo de una bailaora flamenca capturada en pleno taconeo.
                            Retrato expresivo de una bailaora flamenca capturada en pleno taconeo
                            Retrato expresivo de una bailaora flamenca capturada en pleno taconeo
                            Retrato expresivo de una bailaora flamenca capturada en pleno taconeo
                            Retrato expresivo de una bailaora flamenca capturada en pleno taconeo
                            Retrato expresivo de una bailaora flamenca capturada en pleno taconeo',
            'imagen' => 'imagenes/obra3.jpg',
            'metadatos_seo' => 'retrato flamenco, arte realista, carboncillo',
        ]);

        Obra::create([
            'id_artista' => 4,
            'titulo' => 'Sueño Digital',
            'estilo' => 'Arte digital',
            'tecnica' => 'Ilustración digital',
            'tipo' => 'Clasico',
            'año_creacion' => 2024,
            'descripcion' => 'Exploración onírica de un paisaje surrealista creado íntegramente con herramientas digitales.
                            Exploración onírica de un paisaje surrealista creado íntegramente con herramientas digitales.
                            Exploración onírica de un paisaje surrealista creado íntegramente con herramientas digitales.
                            Exploración onírica de un paisaje surrealista creado íntegramente con herramientas digitales.
                            Exploración onírica de un paisaje surrealista creado íntegramente con herramientas digitales.
                            Exploración onírica de un paisaje surrealista creado íntegramente con herramientas digitales.',
            'imagen' => 'imagenes/obra4.jpg',
            'metadatos_seo' => 'arte digital, ilustración surrealista, paisaje onírico',
        ]);

        Obra::factory()->count(30)->create();
    }
}
