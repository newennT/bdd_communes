<?php

namespace App\Entity;

use App\Repository\PaysRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaysRepository::class)]
class Pays
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
    #[ORM\OneToMany(targetEntity: Commune::class, mappedBy: 'id_pays')]
    private Collection $communesParPays;

    public function __construct()
    {
        $this->communesParPays = new ArrayCollection();
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

    public function getNomParLangue(string $locale): ?string 
    {
        return match ($locale) {
            'br' => $this->nom_breton,
            'go' => $this->nom_gallo,
            default => $this->nom_francais,
        };
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
    public function getCommunesParPays(): Collection
    {
        return $this->communesParPays;
    }

    public function addCommunesParPay(Commune $communesParPay): static
    {
        if (!$this->communesParPays->contains($communesParPay)) {
            $this->communesParPays->add($communesParPay);
            $communesParPay->setIdPays($this);
        }

        return $this;
    }

    public function removeCommunesParPay(Commune $communesParPay): static
    {
        if ($this->communesParPays->removeElement($communesParPay)) {
            // set the owning side to null (unless already changed)
            if ($communesParPay->getIdPays() === $this) {
                $communesParPay->setIdPays(null);
            }
        }

        return $this;
    }
}
