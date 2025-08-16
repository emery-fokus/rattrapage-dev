<?php

namespace App\Command;

use App\Entity\Poketype;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(
    name: 'app:import-pokemons',
    description: 'Importe des Pokémon depuis la PokéAPI',
)]
class ImportPokemonsCommand extends Command
{
    private HttpClientInterface $http;
    private EntityManagerInterface $em;

    public function __construct(HttpClientInterface $http, EntityManagerInterface $em)
    {
        parent::__construct();
        $this->http = $http;
        $this->em = $em;
    }

    protected function configure(): void
    {
        $this->addOption('limit', null, InputOption::VALUE_OPTIONAL, 'Nombre de Pokémon à importer', 50);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $limit = (int) $input->getOption('limit');

        for ($id = 1; $id <= $limit; $id++) {
            try {
                $output->writeln("Import du Pokémon #{$id}...");

                $response = $this->http->request('GET', "https://pokeapi.co/api/v2/pokemon/{$id}");
                if ($response->getStatusCode() !== 200) {
                    $output->writeln("⚠️  Erreur avec le Pokémon #{$id}");
                    continue;
                }

                $data = $response->toArray();

                $existing = $this->em->getRepository(Poketype::class)->findOneBy(['pokeApiId' => $data['id']]);
                if ($existing) {
                    $output->writeln("⏩ Pokémon #{$id} déjà en base.");
                    continue;
                }

                $pokemon = new Poketype();
                $pokemon->setPokeApiId($data['id']);
                $pokemon->setName($data['name']);
                $pokemon->setImage($data['sprites']['other']['official-artwork']['front_default'] ?? null);
                $pokemon->setSpriteFront($data['sprites']['front_default'] ?? null);
                $pokemon->setSpriteShiny($data['sprites']['front_shiny'] ?? null);
                $pokemon->setType1($data['types'][0]['type']['name'] ?? null);
                $pokemon->setType2($data['types'][1]['type']['name'] ?? null);

                $this->em->persist($pokemon);
            } catch (\Throwable $e) {
                $output->writeln("❌ Erreur avec le Pokémon #{$id} : " . $e->getMessage());
            }
        }

        $this->em->flush();
        $output->writeln("✅ Import terminé.");

        return Command::SUCCESS;
    }
}
