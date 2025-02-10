<?php

namespace App\Services;

use GuzzleHttp\Client;
use Firebase\JWT\JWT;

class ZoomService
{
    private $apiKey;
    private $apiSecret;
    private $client;

    public function __construct()
    {
        $this->apiKey = env('ZOOM_API_KEY');
        $this->apiSecret = env('ZOOM_API_SECRET');
        $this->client = new Client(['base_uri' => 'https://api.zoom.us/v2/']);
    }

    public function createMeeting($data)
    {
        $token = $this->generateJWTToken();

        $response = $this->client->post('users/me/meetings', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json',
            ],
            'json' => $data,
        ]);

        return json_decode($response->getBody(), true);
    }

    public function generateSignature($meetingNumber, $role = 0)
    {
        $apiKey = env('ZOOM_API_KEY');
        $apiSecret = env('ZOOM_API_SECRET');
        $time = round(microtime(true) * 1000) + 30000;

        $payload = base64_encode($apiKey . $meetingNumber . $time . $role);
        $hash = hash_hmac('sha256', $payload, $apiSecret, true);
        $signature = base64_encode($apiKey . '.' . $meetingNumber . '.' . $time . '.' . $role . '.' . base64_encode($hash));

        return rtrim(strtr($signature, '+/', '-_'), '=');
    }

    private function generateJWTToken()
    {
        $payload = [
            'iss' => $this->apiKey,
            'exp' => time() + 3600, // Token valid for 1 hour
        ];

        return JWT::encode($payload, $this->apiSecret, 'HS256');
    }
}
