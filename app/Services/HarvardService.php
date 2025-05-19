<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class HarvardService
{
    protected $baseUrl = 'https://api.harvardartmuseums.org/object';

    public function search($params = [])
    {
        $params['apikey'] = config('services.harvard.key');
        $params['size'] = $params['size'] ?? 10;

        $response = Http::get($this->baseUrl, $params);

        return $response->json();
    }


}
