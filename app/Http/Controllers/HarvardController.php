<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HarvardService;

class HarvardController extends Controller
{
    public function index(Request $request, HarvardService $harvard)
    {
        $artist = $request->input('artist');

        $results = $this->buscarObras($harvard, $artist);

        return view('apis.harvard_index', [
            'artworks' => $results['records'] ?? [],
            'artist' => $artist
        ]);
    }

    private function buscarObras(HarvardService $harvard, ?string $artist): array
    {
        $params = [
            'classification' => 'Paintings',
            'size' => 10,
            'sort' => 'random'
        ];

        if ($artist) {
            $params['person'] = $artist;
        }

        return $harvard->search($params);
    }

}
