<?php

namespace App\Entity;

use App\Repository\CittaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CittaRepository::class)]
class Citta
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name:'id_city')]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nome_citta = null;

    #[ORM\Column(length: 100)]
    private ?string $stato = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomeCitta(): ?string
    {
        return $this->nome_citta;
    }

    public function setNomeCitta(string $nome_citta): static
    {
        $this->nome_citta = $nome_citta;

        return $this;
    }

    public function getStato(): ?string
    {
        return $this->stato;
    }

    public function setStato(string $stato): static
    {
        $this->stato = $stato;

        return $this;
    }
}
