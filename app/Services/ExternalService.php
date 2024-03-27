<?php

namespace App\Services;

use GuzzleHttp\Client;

class ExternalService
{
    public function getAccess()
    {
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

        return json_decode($response->getBody(), true);
    }

    public function getOrder($id)
    {
        $client = new Client();
        $url = "https://rocky-beyond-58885-df0762919b44.herokuapp.com/orders/$id";
        $token = $this->getAccess()['access_token'];
        $headers = [
            'Authorization' => "Bearer $token",
        ];

        $response = $client->request('GET', $url, [
            'headers' => $headers
        ]);

        return json_decode($response->getBody(), true);
    }
}