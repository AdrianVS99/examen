<?php

namespace App\Entity;

use App\Repository\VotoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VotoRepository::class)]
class Voto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $votos = null;

    #[ORM\ManyToOne(inversedBy: 'votos')]
    private ?Sindicato $sindicato = null;

    #[ORM\ManyToOne(inversedBy: 'votos')]
    private ?Mesa $mesa = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVotos(): ?int
    {
        return $this->votos;
    }

    public function setVotos(int $votos): static
    {
        $this->votos = $votos;

        return $this;
    }

    public function getSindicato(): ?Sindicato
    {
        return $this->sindicato;
    }

    public function setSindicato(?Sindicato $sindicato): static
    {
        $this->sindicato = $sindicato;

        return $this;
    }

    public function getMesa(): ?Mesa
    {
        return $this->mesa;
    }

    public function setMesa(?Mesa $mesa): static
    {
        $this->mesa = $mesa;

        return $this;
    }
}
