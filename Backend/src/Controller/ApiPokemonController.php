<?php

namespace App\Controller;

use App\Repository\PoketypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiPokemonController extends AbstractController
{
    #[Route('/api/pokemons', name: 'api_pokemons_list', methods: ['GET'])]
    public function index(PoketypeRepository $repository): JsonResponse
    {
        $pokemons = $repository->findAll();

        $data = [];

        foreach ($pokemons as $pokemon) {
            $data[] = [
                'id' => $pokemon->getId(),
                'pokeApiId' => $pokemon->getPokeApiId(),
                'name' => $pokemon->getName(),
                'image' => $pokemon->getImage(),
                'spriteFront' => $pokemon->getSpriteFront(),
                'spriteShiny' => $pokemon->getSpriteShiny(),
                'type1' => $pokemon->getType1(),
                'type2' => $pokemon->getType2(),
            ];
        }

        return $this->json($data);
    }
}
