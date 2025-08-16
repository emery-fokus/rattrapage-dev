<?php

namespace App\Controller;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    private HttpClientInterface $http;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->http = $httpClient;
    }

    #[Route('/test-api', name: 'test_api')]
    public function testApi(): JsonResponse
    {
        $response = $this->http->request('GET', 'https://pokeapi.co/api/v2/pokemon/25');  //methode get pour afficher les donnees 
        $data = $response->toArray();

        return new JsonResponse($data);
    }
}


