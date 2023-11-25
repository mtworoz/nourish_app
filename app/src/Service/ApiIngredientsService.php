<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiIngredientsService
{
    private string $apiURL;
    private HttpClientInterface $client;

    public function __construct()
    {
        $this->apiURL = 'http://nginx-service-macromap/api/products';
        $this->client = HttpClient::create();
    }

    public function get(){
        $response = $this->client->request('GET', $this->apiURL);
        $data = $response->getContent();
        return json_decode($data)->{'hydra:member'};
    }

}
