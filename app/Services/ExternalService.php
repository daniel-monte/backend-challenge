<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

class ExternalService
{
    protected $accessURL;

    public function __construct()
    {
        $this->accessURL = env("WIN_ACCESS_URL");
    }

    public function getAccess()
    {
        if (!(Session::has('token_expires_at') && now() < Session::get('token_expires_at'))) {
            $client = new Client();
            $headers = [
                'Content-Type' => 'application/json',
            ];
            $body = '{
                "email": "'.env("WIN_EMAIL").'",
                "password": "'.env("WIN_PASSWORD").'"
            }';

            $response = $client->request('GET', "$this->accessURL/login", [
                'headers' => $headers,
                'body' => $body
            ]);

            $tokenData = json_decode($response->getBody(), true);

            Session::put('token', $tokenData['access_token']);
            Session::put('token_expires_at', now()->addSeconds($tokenData['expires_in']));
        }

        return Session::get('token');
    }

    public function getOrder($id)
    {
        $client = new Client();
        $token = $this->getAccess();
        $headers = [
            'Authorization' => "Bearer $token",
        ];

        $response = $client->request('GET', "$this->accessURL/orders/$id", [
            'headers' => $headers
        ]);

        return json_decode($response->getBody(), true);
    }
}