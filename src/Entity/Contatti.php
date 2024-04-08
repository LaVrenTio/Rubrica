<?php

namespace App\Entity;

use App\Repository\ContattiRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContattiRepository::class)]
class Contatti
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nome = null;

    #[ORM\Column(length: 50)]
    private ?string $cognome = null;

    #[ORM\Column(length: 50)]
    private ?string $email = null;

    #[ORM\Column(length: 1)]
    private ?string $sesso = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $citta = null;

    #[ORM\Column(length: 50)]
    private ?string $telefono = null;

    private ?Citta $mycitta=null;

    public function getMycitta(): ?Citta {
        return $this->mycitta;
    }

    // Setter per $mycitta
    public function setMycitta(?Citta $mycitta): void {
        $this->mycitta = $mycitta;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): static
    {
        $this->nome = $nome;

        return $this;
    }

    public function getCognome(): ?string
    {
        return $this->cognome;
    }

    public function setCognome(string $cognome): static
    {
        $this->cognome = $cognome;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getSesso(): ?string
    {
        return $this->sesso;
    }

    public function setSesso(string $sesso): static
    {
        $this->sesso = $sesso;

        return $this;
    }

    public function getCitta(): ?string
    {
        return $this->mycitta->getNomeCitta();
    }

    public function setCitta(?string $citta): static
    {
        $this->citta = $citta;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): static
    {
        $this->telefono = $telefono;

        return $this;
    }
}
