<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class RijksmuseumController extends Controller
{
    //RIJKSMUSEUM_API_KEY

    public function verApi()
    {
        return view("apis.index");
    }

    public function verObras(Request $request)
    {
        $pagina = $request->input('page', 1); // Valor por defecto: página 1

        $response = Http::get('https://www.rijksmuseum.nl/api/en/collection', [
            'key' => env('RIJKSMUSEUM_API_KEY'),
            'format' => 'json',
            'imgonly' => true,
            'ps' => 8,
            'p' => $pagina,
            's' => 'relevance',
        ]);

        $obras = $response['artObjects'] ?? [];
        $total = $response['count'] ?? 0; // Total de resultados
        $porPagina = 8;

        // Crear una instancia de LengthAwarePaginator para paginar "a mano"
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $obras,
            $total,
            $porPagina,
            $pagina,
            ['path' => route('rijks.obras')] // Ruta base
        );

        return view('apis.verObras', ['obras' => $paginator]);
    }

    public function buscar(Request $request)
    {
        $query = $request->input('q', 'Rembrandt');

        $response = Http::get('https://www.rijksmuseum.nl/api/en/collection', [
            'key' => env('RIJKS_API_KEY'),
            'format' => 'json',
            'q' => $query,
            'imgonly' => true,
        ]);

        $obras = $response['artObjects'] ?? [];

        return view('rijks.buscar', compact('obras'));
    }
}
