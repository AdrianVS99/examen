<?php

namespace App\Entity;

use App\Repository\ParametroRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParametroRepository::class)]
class Parametro
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $parametro = null;

    #[ORM\Column(length: 255)]
    private ?string $valor = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParametro(): ?string
    {
        return $this->parametro;
    }

    public function setParametro(string $parametro): static
    {
        $this->parametro = $parametro;

        return $this;
    }

    public function getValor(): ?string
    {
        return $this->valor;
    }

    public function setValor(string $valor): static
    {
        $this->valor = $valor;

        return $this;
    }
}
