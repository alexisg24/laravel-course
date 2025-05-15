<?php

namespace App\ExternalService;

use App\ExternalService\Events\DataGet;
use Illuminate\Support\Facades\Http;

class ApiService
{
    protected string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function getData()
    {
        $response = Http::get($this->url);
        if ($response->failed()) {
            event(new DataGet(['error' => "Error getting data from {$this->url}"]));
            return ['error' => "Error getting data from {$this->url}"];
        }
        event(new DataGet(['data' => count($response->json())]));
        return $response->json();
    }
}
