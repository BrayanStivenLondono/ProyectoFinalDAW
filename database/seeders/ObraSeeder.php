<?php

namespace Database\Seeders;

use App\Models\Obra;
use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ObraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asegúrate de tener artistas ya en la base de datos
        $artistas = Usuario::where('tipo', 'artista')->get();

        if ($artistas->isEmpty()) {
            $this->command->warn("No hay artistas en la base de datos. Por favor, ejecuta primero el seeder de usuarios.");
            return;
        }

        $obras = [
            [
                'titulo' => 'La noche estrellada',
                'estilo' => 'Postimpresionismo',
                'tecnica' => 'Óleo sobre lienzo',
                'tipo' => 'Pintura',
                'año_creacion' => 1889,
                'descripcion' => 'Una representación de un cielo nocturno con remolinos vibrantes.',
                'imagen' => 'imagenes/obras/noche_estrellada.jpg',
                'metadatos_seo' => 'van Gogh, noche estrellada, pintura postimpresionista',
            ],
            [
                'titulo' => 'La joven de la perla',
                'estilo' => 'Barroco',
                'tecnica' => 'Óleo sobre lienzo',
                'tipo' => 'Retrato',
                'año_creacion' => 1665,
                'descripcion' => 'Una joven con un pendiente de perla, obra icónica de Vermeer.',
                'imagen' => 'imagenes/obras/joven_perla.jpg',
                'metadatos_seo' => 'Vermeer, retrato, perla',
            ],
            [
                'titulo' => 'El grito',
                'estilo' => 'Expresionismo',
                'tecnica' => 'Tempera y pastel',
                'tipo' => 'Pintura',
                'año_creacion' => 1893,
                'descripcion' => 'Figura angustiada bajo un cielo rojo, por Edvard Munch.',
                'imagen' => 'imagenes/obras/el_grito.jpg',
                'metadatos_seo' => 'El grito, Munch, arte expresionista',
            ],
            [
                'titulo' => 'La última cena',
                'estilo' => 'Renacimiento',
                'tecnica' => 'Tempera sobre yeso',
                'tipo' => 'Mural',
                'año_creacion' => 1498,
                'descripcion' => 'Cristo y sus discípulos en su última cena, por Da Vinci.',
                'imagen' => 'imagenes/obras/ultima_cena.jpg',
                'metadatos_seo' => 'Última cena, Da Vinci, mural religioso',
            ],
            [
                'titulo' => 'Las meninas',
                'estilo' => 'Barroco',
                'tecnica' => 'Óleo sobre lienzo',
                'tipo' => 'Retrato',
                'año_creacion' => 1656,
                'descripcion' => 'Retrato de la infanta Margarita junto a sus damas de honor.',
                'imagen' => 'imagenes/obras/las_meninas.jpg',
                'metadatos_seo' => 'Velázquez, meninas, retrato barroco',
            ],
            [
                'titulo' => 'El nacimiento de Venus',
                'estilo' => 'Renacimiento',
                'tecnica' => 'Tempera sobre lienzo',
                'tipo' => 'Pintura',
                'año_creacion' => 1486,
                'descripcion' => 'Venus emergiendo del mar sobre una concha, de Botticelli.',
                'imagen' => 'imagenes/obras/venus.jpg',
                'metadatos_seo' => 'Botticelli, Venus, renacimiento',
            ],
            [
                'titulo' => 'La persistencia de la memoria',
                'estilo' => 'Surrealismo',
                'tecnica' => 'Óleo sobre lienzo',
                'tipo' => 'Pintura',
                'año_creacion' => 1931,
                'descripcion' => 'Relojes derritiéndose en un paisaje onírico, por Dalí.',
                'imagen' => 'imagenes/obras/persistencia_memoria.jpg',
                'metadatos_seo' => 'Dalí, surrealismo, relojes',
            ],
            [
                'titulo' => 'El jardín de las delicias',
                'estilo' => 'Renacimiento',
                'tecnica' => 'Óleo sobre tabla',
                'tipo' => 'Tríptico',
                'año_creacion' => 1505,
                'descripcion' => 'Tres paneles que muestran el paraíso, el pecado y el infierno.',
                'imagen' => 'imagenes/obras/jardin_delicias.jpg',
                'metadatos_seo' => 'El Bosco, tríptico, infierno',
            ],
            [
                'titulo' => 'El beso',
                'estilo' => 'Art Nouveau',
                'tecnica' => 'Óleo y pan de oro',
                'tipo' => 'Pintura',
                'año_creacion' => 1908,
                'descripcion' => 'Una pareja abrazada y decorada con patrones dorados, de Klimt.',
                'imagen' => 'imagenes/obras/el_beso.jpg',
                'metadatos_seo' => 'Klimt, el beso, art nouveau',
            ],
            [
                'titulo' => 'Impresión sol naciente',
                'estilo' => 'Impresionismo',
                'tecnica' => 'Óleo sobre lienzo',
                'tipo' => 'Paisaje',
                'año_creacion' => 1872,
                'descripcion' => 'Obra que dio nombre al movimiento impresionista, de Monet.',
                'imagen' => 'imagenes/obras/impresion_sol.jpg',
                'metadatos_seo' => 'Monet, impresionismo, sol naciente',
            ],
            [
                'titulo' => 'La libertad guiando al pueblo',
                'estilo' => 'Romanticismo',
                'tecnica' => 'Óleo sobre lienzo',
                'tipo' => 'historica',
                'año_creacion' => 1830,
                'descripcion' => 'Representación alegórica de la Revolución Francesa, por Delacroix.',
                'imagen' => 'imagenes/obras/libertad_pueblo.jpg',
                'metadatos_seo' => 'Delacroix, libertad, revolución',
            ],
        ];

        $obrasTematicas = [
            [
                'titulo' => 'Velocidad de Medianoche',
                'estilo' => 'Realismo moderno',
                'tecnica' => 'Óleo sobre lienzo',
                'tipo' => 'Automovilismo',
                'año_creacion' => 2020,
                'descripcion' => 'Un deportivo futurista cruza una ciudad iluminada por neones.',
                'imagen' => 'imagenes/obras/auto_veloz.jpg',
                'metadatos_seo' => 'coche, arte moderno, velocidad, ciudad futurista',
            ],
            [
                'titulo' => 'Guardianes de la Sabana',
                'estilo' => 'Naturaleza realista',
                'tecnica' => 'Acuarela',
                'tipo' => 'Animales',
                'año_creacion' => 2021,
                'descripcion' => 'Leones y elefantes representados en armonía en su hábitat natural.',
                'imagen' => 'imagenes/obras/sabana_animales.jpg',
                'metadatos_seo' => 'leones, elefantes, fauna, acuarela',
            ],
            [
                'titulo' => 'Samurái Digital',
                'estilo' => 'Anime futurista',
                'tecnica' => 'Arte digital',
                'tipo' => 'Ilustración anime',
                'año_creacion' => 2022,
                'descripcion' => 'Un guerrero cibernético inspirado en los animes clásicos y sci-fi.',
                'imagen' => 'imagenes/obras/samurai_digital.jpg',
                'metadatos_seo' => 'anime, samurái, ilustración digital, cyberpunk',
            ],
            [
                'titulo' => 'Camino a la gloria',
                'estilo' => 'Arte conceptual deportivo',
                'tecnica' => 'Mixta',
                'tipo' => 'Deporte',
                'año_creacion' => 2019,
                'descripcion' => 'Juegos olimpicos celebrados en Barcelona',
                'imagen' => 'imagenes/obras/juegos_olimpicos.jpg',
                'metadatos_seo' => 'fútbol, gol, arte deportivo, energía',
            ],
            [
                'titulo' => 'Sombras del alma',
                'estilo' => 'Fotografía artística',
                'tecnica' => 'Blanco y negro',
                'tipo' => 'Retrato',
                'año_creacion' => 2018,
                'descripcion' => 'Rostro iluminado por una sola fuente de luz, transmitiendo introspección.',
                'imagen' => 'imagenes/obras/sombras_bn.jpg',
                'metadatos_seo' => 'blanco y negro, fotografía, alma, introspección',
            ],
            [
                'titulo' => 'Ritmo urbano',
                'estilo' => 'Pop art callejero',
                'tecnica' => 'Spray sobre madera',
                'tipo' => 'Cultura urbana',
                'año_creacion' => 2020,
                'descripcion' => 'Grafiti de una figura bailando hip hop entre altavoces y grafos.',
                'imagen' => 'imagenes/obras/ritmo_urbano.jpg',
                'metadatos_seo' => 'graffiti, urbano, pop art, hip hop',
            ],
        ];


        foreach ($obras as $obra) {
            $obra['id_artista'] = $artistas->random()->id;
            $obra['created_at'] = now();
            $obra['updated_at'] = now();

            Obra::create($obra);
        }

        foreach ($obrasTematicas as $obra) {
            Obra::create(array_merge($obra, [
                'id_artista' => Usuario::inRandomOrder()->where('tipo', 'artista')->first()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
