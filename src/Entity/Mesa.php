<?php

namespace App\Entity;

use App\Repository\MesaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MesaRepository::class)]
class Mesa
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $mesa = null;

    #[ORM\Column(length: 255)]
    private ?string $centro = null;

    #[ORM\Column(length: 255)]
    private ?string $localidad = null;

    #[ORM\OneToMany(targetEntity: Voto::class, mappedBy: 'mesa')]
    private Collection $votos;

    #[ORM\Column]
    private ?bool $oculta = null;

    public function __construct()
    {
        $this->votos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMesa(): ?int
    {
        return $this->mesa;
    }

    public function setMesa(int $mesa): static
    {
        $this->mesa = $mesa;

        return $this;
    }

    public function getCentro(): ?string
    {
        return $this->centro;
    }

    public function setCentro(string $centro): static
    {
        $this->centro = $centro;

        return $this;
    }

    public function getLocalidad(): ?string
    {
        return $this->localidad;
    }

    public function setLocalidad(string $localidad): static
    {
        $this->localidad = $localidad;

        return $this;
    }

    /**
     * @return Collection<int, Voto>
     */
    public function getVotos(): Collection
    {
        return $this->votos;
    }

    public function addVoto(Voto $voto): static
    {
        if (!$this->votos->contains($voto)) {
            $this->votos->add($voto);
            $voto->setMesa($this);
        }

        return $this;
    }

    public function removeVoto(Voto $voto): static
    {
        if ($this->votos->removeElement($voto)) {
            // set the owning side to null (unless already changed)
            if ($voto->getMesa() === $this) {
                $voto->setMesa(null);
            }
        }

        return $this;
    }

    public function isOculta(): ?bool
    {
        return $this->oculta;
    }

    public function setOculta(bool $oculta): static
    {
        $this->oculta = $oculta;

        return $this;
    }
}
