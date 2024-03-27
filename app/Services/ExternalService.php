<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

class ExternalService
{
    public function getAccess()
    {
        if (!(Session::has('token_expires_at') && now() < Session::get('token_expires_at'))) {
            //por cuestiones de practicidad afines a esta prueba preferi no enviar estas variables desde el .env 
            $client = new Client();
            $url = 'https://rocky-beyond-58885-df0762919b44.herokuapp.com/login';
            $headers = [
                'Content-Type' => 'application/json',
            ];
            $body = '{
                "email": "jhon@win.investments",
                "password": "password"
            }';

            $response = $client->request('GET', $url, [
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
        $url = "https://rocky-beyond-58885-df0762919b44.herokuapp.com/orders/$id";
        $token = $this->getAccess();
        $headers = [
            'Authorization' => "Bearer $token",
        ];

        $response = $client->request('GET', $url, [
            'headers' => $headers
        ]);

        return json_decode($response->getBody(), true);
    }
}