<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HarvardService;

class HarvardController extends Controller
{
    public function index(Request $request, HarvardService $harvard)
    {
        $artist = $request->input('artist');

        $params = [
            'classification' => 'Paintings',
            'size' => 10,
            'sort' => 'random'
        ];

        if ($artist) {
            $params['person'] = $artist;
        }

        $results = $harvard->search($params);

        return view('apis.harvard_index', [
            'artworks' => $results['records'] ?? [],
            'artist' => $artist
        ]);
    }
}
