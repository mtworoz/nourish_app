<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;

class ApiIngredientsService
{
    public function get(){
        $client = HttpClient::create();

        $apiUrl = 'http://localhost:8088/api/nutrients';

        $response = $client->request('GET', $apiUrl);

        $statusCode = $response->getStatusCode();

        $data = $response->toArray();

        return new Response(json_encode($data), $statusCode);
    }

}
