<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;

class ServiceDaoImpl implements ServiceDao
{
    protected $apiUrl, $apiKey;
    public function __construct()
    {
        $this->apiUrl = config('service.supabase.api_url');
        $this->apiKey = config('service.supabase.api_key');
    }

    public function getAllLevel()
    {
    }
    public function createLevel($data)
    {
        $response = Http::withHeaders([
            'apikey' => $this->apiKey,
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
            'Prefer' => 'return=minimal',
        ])->post("{$this->apiUrl}/rest/v1/levels", $data);
        if ($response->successful()) {
            return $response->json();
        }
        return $response->throw()->json();
    }
    public function findLevel()
    {
    }
    public function deleteLevel()
    {
    }
    public function updateLevel()
    {
    }
}
