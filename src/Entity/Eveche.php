<?php

namespace App\Entity;

use App\Repository\EvecheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvecheRepository::class)]
class Eveche
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_francais = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom_breton = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom_gallo = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    /**
     * @var Collection<int, Commune>
     */
    #[ORM\OneToMany(targetEntity: Commune::class, mappedBy: 'id_eveche')]
    private Collection $communesParEveche;

    public function __construct()
    {
        $this->communesParEveche = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static 
    {
        $this->id = $id;
        return $this;
    }

    public function getNomFrancais(): ?string
    {
        return $this->nom_francais;
    }

    public function setNomFrancais(string $nom_francais): static
    {
        $this->nom_francais = $nom_francais;

        return $this;
    }

    public function getNomBreton(): ?string
    {
        return $this->nom_breton;
    }

    public function setNomBreton(?string $nom_breton): static
    {
        $this->nom_breton = $nom_breton;

        return $this;
    }

    public function getNomGallo(): ?string
    {
        return $this->nom_gallo;
    }

    public function setNomGallo(?string $nom_gallo): static
    {
        $this->nom_gallo = $nom_gallo;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Commune>
     */
    public function getCommunesParEveche(): Collection
    {
        return $this->communesParEveche;
    }

    public function addCommunesParEveche(Commune $communesParEveche): static
    {
        if (!$this->communesParEveche->contains($communesParEveche)) {
            $this->communesParEveche->add($communesParEveche);
            $communesParEveche->setIdEveche($this);
        }

        return $this;
    }

    public function removeCommunesParEveche(Commune $communesParEveche): static
    {
        if ($this->communesParEveche->removeElement($communesParEveche)) {
            // set the owning side to null (unless already changed)
            if ($communesParEveche->getIdEveche() === $this) {
                $communesParEveche->setIdEveche(null);
            }
        }

        return $this;
    }
}
