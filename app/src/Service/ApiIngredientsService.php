<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;

class ApiIngredientsService
{
    public function get(){
        $client = HttpClient::create();

        $apiUrl = 'http://nginx-service-macromap/api/products';

        $response = $client->request('GET', $apiUrl);

        $statusCode = $response->getStatusCode();

        $data = $response->getContent();

        return new Response(json_encode($data), $statusCode);
    }

}
