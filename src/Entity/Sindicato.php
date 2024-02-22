<?php

namespace App\Entity;

use App\Repository\SindicatoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SindicatoRepository::class)]
class Sindicato
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $sindicato = null;

    #[ORM\Column(length: 255)]
    private ?string $logo = null;

    #[ORM\OneToMany(targetEntity: Voto::class, mappedBy: 'sindicato')]
    private Collection $votos;

    public function __construct()
    {
        $this->votos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSindicato(): ?string
    {
        return $this->sindicato;
    }

    public function setSindicato(string $sindicato): static
    {
        $this->sindicato = $sindicato;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): static
    {
        $this->logo = $logo;

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
            $voto->setSindicato($this);
        }

        return $this;
    }

    public function removeVoto(Voto $voto): static
    {
        if ($this->votos->removeElement($voto)) {
            // set the owning side to null (unless already changed)
            if ($voto->getSindicato() === $this) {
                $voto->setSindicato(null);
            }
        }

        return $this;
    }
}
