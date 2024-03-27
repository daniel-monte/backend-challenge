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
            'Cookie' => 'XSRF-TOKEN=eyJpdiI6Ijk5WjNBTi9JdTE0UEFCOUh5OThzUHc9PSIsInZhbHVlIjoia3BsSkx5bU5tYTZFNExIUEJGTHozbm5rdTRXSHhjL1lTc2RyVXJPUjlPVWtHUloyOGJzVGw2dnJ5bkFMMHdJTDczdFc3SjhkNnVUYmgwbFViQThTOS9Ma1d4S1FPOUlEVDU3NlRnL1JiRlhQUkp3V01oc1dLTkpDWEpjb3ZyTksiLCJtYWMiOiI4ZjZkYWY5YTFjZGVhMzYwMTk4YmM2ZTBkZTQzNmExYzNhYzFmZTM0YmUyZDE2ODI2MzhlMjNhMDg4ZGE2NTIxIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IkpnblJOY2xCNzN6QXAwZC9FQXFhQXc9PSIsInZhbHVlIjoiUHc0eVhzanhpbS9hd1NHUFlhZVExZGxnT1VLYjF3TkdjQWlsaysyT0RtUjVyT1BRMTc1UENHNFZXTDFxSDR3NE5Cc1AzZTZhWHIxTWkzMDVIM2UrTWlWTmkvZk9yMGJJQzVBdnY1NTRjcnpaWTFVMFNkOVk0VVpyb3hUbnNQWS8iLCJtYWMiOiJhZjAyZGM4NzJhMDAyNDk4NWVkY2NhOTA0OTE2YTRlODQ2NTZiZDliYmExZjY3YjcxMzU3Y2NkYThlMTM3MDIwIiwidGFnIjoiIn0%3D'
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
}