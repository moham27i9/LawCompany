<?php

namespace App\Services;

use GuzzleHttp\Client;
use Firebase\JWT\JWT;

class FcmService
{
    private function getAccessToken(): ?string
    {
        $clientEmail = config('services.fcm.client_email');
        $privateKey  = config('services.fcm.private_key');
        $projectId   = config('services.fcm.project_id');

        if (!$clientEmail || !$privateKey || !$projectId) {
            return null;
        }

        $now = time();
        $token = [
            'iss'   => $clientEmail,
            'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
            'aud'   => 'https://oauth2.googleapis.com/token',
            'iat'   => $now,
            'exp'   => $now + 3600,
        ];

        // توليد JWT
        $jwt = JWT::encode($token, $privateKey, 'RS256');

        // تبادل JWT بـ access token
        $client = new Client();
        $response = $client->post('https://oauth2.googleapis.com/token', [
            'form_params' => [
                'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                'assertion'  => $jwt,
            ],
        ]);

        $body = json_decode($response->getBody(), true);
        return $body['access_token'] ?? null;
    }

    public function send(string $toToken, string $title, string $body, array $data = []): void
    {
        if (!$toToken) return;

        $accessToken = $this->getAccessToken();
        if (!$accessToken) return;

        $projectId = config('services.fcm.project_id');

        $payload = [
            'message' => [
                'token' => $toToken,
                'notification' => [
                    'title' => $title,
                    'body'  => $body,
                ],
                'data' => $data,
            ],
        ];

        $client = new Client();
        $client->post("https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send", [
            'headers' => [
                'Authorization' => "Bearer {$accessToken}",
                'Content-Type'  => 'application/json',
            ],
            'json' => $payload,
            'timeout' => 10,
        ]);
    }
}
