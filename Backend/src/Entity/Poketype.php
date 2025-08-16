<?php

namespace App\Entity;

use App\Repository\PoketypeRepository;//
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PoketypeRepository::class)] 
class Poketype
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private int $pokeApiId;

    #[ORM\Column(length: 100)]
    private string $name;

    #[ORM\Column(length: 255)]
    private string $image;

    #[ORM\Column(length: 255)]
    private string $spriteFront;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $spriteShiny = null;

    #[ORM\Column(length: 50)]
    private string $type1;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $type2 = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPokeApiId(): int
    {
        return $this->pokeApiId;
    }

    public function setPokeApiId(int $pokeApiId): static
    {
        $this->pokeApiId = $pokeApiId;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;
        return $this;
    }

    public function getSpriteFront(): string
    {
        return $this->spriteFront;
    }

    public function setSpriteFront(string $spriteFront): static
    {
        $this->spriteFront = $spriteFront;
        return $this;
    }

    public function getSpriteShiny(): ?string
    {
        return $this->spriteShiny;
    }

    public function setSpriteShiny(?string $spriteShiny): static
    {
        $this->spriteShiny = $spriteShiny;
        return $this;
    }

    public function getType1(): string
    {
        return $this->type1;
    }

    public function setType1(string $type1): static
    {
        $this->type1 = $type1;
        return $this;
    }

    public function getType2(): ?string
    {
        return $this->type2;
    }

    public function setType2(?string $type2): static
    {
        $this->type2 = $type2;
        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
