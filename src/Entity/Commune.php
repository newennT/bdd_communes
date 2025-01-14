<?php

namespace App\Entity;

use App\Repository\CommuneRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommuneRepository::class)]
class Commune
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

    #[ORM\Column]
    private ?int $habitants = null;

    #[ORM\Column]
    private ?float $latitude = null;

    #[ORM\Column]
    private ?float $longitude = null;

    #[ORM\ManyToOne(inversedBy: 'communesParEveche')]
    private ?Eveche $id_eveche = null;

    #[ORM\ManyToOne(inversedBy: 'communesParPays')]
    private ?Pays $id_pays = null;

    #[ORM\Column]
    private ?int $code = null;

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
            'go' => $this->nom_gallo ?: $this->nom_francais,
            default => $this->nom_francais,
        };
    }

    public function getHabitants(): ?int
    {
        return $this->habitants;
    }

    public function setHabitants(int $habitants): static
    {
        $this->habitants = $habitants;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getIdEveche(): ?Eveche
    {
        return $this->id_eveche;
    }

    public function setIdEveche(?Eveche $id_eveche): static
    {
        $this->id_eveche = $id_eveche;

        return $this;
    }

    public function getIdPays(): ?Pays
    {
        return $this->id_pays;
    }

    public function setIdPays(?Pays $id_pays): static
    {
        $this->id_pays = $id_pays;

        return $this;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): static
    {
        $this->code = $code;

        return $this;
    }
}
