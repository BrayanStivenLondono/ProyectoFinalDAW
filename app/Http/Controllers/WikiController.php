<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WikiController extends Controller
{
    public function resumen(Request $request)
    {
        $termino = $request->input('termino');

        // Normalizar el término para la URL (espacios por _)
        $busqueda = str_replace(' ', '_', $termino);

        $url = "https://es.wikipedia.org/api/rest_v1/page/summary/{$busqueda}";

        $response = Http::get($url);

        if ($response->successful()) {
            $data = $response->json();

            return response()->json([
                'titulo' => $data['title'] ?? $termino,
                'extracto' => $data['extract'] ?? 'No hay resumen disponible.',
                'url' => $data['content_urls']['desktop']['page'] ?? null,
            ]);
        }

        return response()->json(['error' => 'No se encontró información.'], 404);
    }

}
