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
    // setting
    public function updateSetting($data)
    {
        $response = Http::withHeaders([
            'apikey' => $this->apiKey,
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->get("{$this->apiUrl}/rest/v1/settings");

        if ($response->successful()) {
            return $response->json();
        }

        return $response->throw()->json();
    }
    public function getAllLevel()
    {
        $response = Http::withHeaders([
            'apikey' => $this->apiKey,
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->get("{$this->apiUrl}/rest/v1/levels");

        if ($response->successful()) {
            return $response->json();
        }

        return $response->throw()->json();
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

    public function findLevel($id)
    {
        $response = Http::withHeaders([
            'apikey' => $this->apiKey,
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->get("{$this->apiUrl}/rest/v1/levels?id=eq.{$id}");

        if ($response->successful()) {
            return $response->json();
        }

        return $response->throw()->json();
    }

    public function updateLevel($id, $data)
    {
        $response = Http::withHeaders([
            'apikey' => $this->apiKey,
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
            'Prefer' => 'return=minimal',
        ])->patch("{$this->apiUrl}/rest/v1/levels?id=eq.{$id}", $data);

        if ($response->successful()) {
            return $response->json();
        }

        return $response->throw()->json();
    }

    public function deleteLevel($id)
    {
        $response = Http::withHeaders([
            'apikey' => $this->apiKey,
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
            'Prefer' => 'return=minimal',
        ])->delete("{$this->apiUrl}/rest/v1/levels?id=eq.{$id}");

        if ($response->successful()) {
            return $response->json();
        }

        return $response->throw()->json();
    }

    // user
    public function createUser($data)
    {
        $response = Http::withHeaders([
            'apikey' => $this->apiKey,
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
            'Prefer' => 'return=minimal',
        ])->post("{$this->apiUrl}/rest/v1/users", $data);

        if ($response->successful()) {
            return $response->json();
        }

        return $response->throw()->json();
    }
    public function findUser($id)
    {
        $response = Http::withHeaders([
            'apikey' => $this->apiKey,
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->get("{$this->apiUrl}/rest/v1/users?id=eq.{$id}");

        if ($response->successful()) {
            return $response->json();
        }

        return $response->throw()->json();
    }
    public function updateUser($id, $data)
    {
        $response = Http::withHeaders([
            'apikey' => $this->apiKey,
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
            'Prefer' => 'return=minimal',
        ])->patch("{$this->apiUrl}/rest/v1/users?id=eq.{$id}", $data);

        if ($response->successful()) {
            return $response->json();
        }

        return $response->throw()->json();
    }
    public function deleteUser($id)
    {
        $response = Http::withHeaders([
            'apikey' => $this->apiKey,
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
            'Prefer' => 'return=minimal',
        ])->delete("{$this->apiUrl}/rest/v1/users?id=eq.{$id}");

        if ($response->successful()) {
            return $response->json();
        }
        return $response->throw()->json();
    }
}
