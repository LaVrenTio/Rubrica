<?php

namespace App\Entity;

use App\Repository\SquadraRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SquadraRepository::class)]
class Squadra
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
