<?php

namespace App\Entity;

use App\Repository\AdresseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdresseRepository::class)]
#[ORM\Index(name: "adresse_index", columns: ['id_unique'], flags: ['fulltext'])]
class Adresse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $idUnique = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $idFantoir = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $numero = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $rep = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nomVoie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $codePostal = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $codeInsee = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nomCommune = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $codeInseeAncienneCommune = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nomAncienneCommune = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $x = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $y = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lon = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lat = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $typePosition = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $alias = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nomLd = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $libelleAcheminement = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nomAfnor = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sourcePosition = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sourceNomVoie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $certificationCommune = null;

    #[ORM\Column(type: Types::TEXT, length: 65535, nullable: true)]
    private ?string $cadParcelles = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUnique(): ?string
    {
        return $this->idUnique;
    }

    public function setIdUnique(?string $idUnique): static
    {
        $this->idUnique = $idUnique;

        return $this;
    }

    public function getIdFantoir(): ?string
    {
        return $this->idFantoir;
    }

    public function setIdFantoir(?string $idFantoir): static
    {
        $this->idFantoir = $idFantoir;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(?string $numero): static
    {
        $this->numero = $numero;

        return $this;
    }

    public function getRep(): ?string
    {
        return $this->rep;
    }

    public function setRep(?string $rep): static
    {
        $this->rep = $rep;

        return $this;
    }

    public function getNomVoie(): ?string
    {
        return $this->nomVoie;
    }

    public function setNomVoie(?string $nomVoie): static
    {
        $this->nomVoie = $nomVoie;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(?string $codePostal): static
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getCodeInsee(): ?string
    {
        return $this->codeInsee;
    }

    public function setCodeInsee(?string $codeInsee): static
    {
        $this->codeInsee = $codeInsee;

        return $this;
    }

    public function getNomCommune(): ?string
    {
        return $this->nomCommune;
    }

    public function setNomCommune(?string $nomCommune): static
    {
        $this->nomCommune = $nomCommune;

        return $this;
    }

    public function getCodeInseeAncienneCommune(): ?string
    {
        return $this->codeInseeAncienneCommune;
    }

    public function setCodeInseeAncienneCommune(?string $codeInseeAncienneCommune): static
    {
        $this->codeInseeAncienneCommune = $codeInseeAncienneCommune;

        return $this;
    }

    public function getNomAncienneCommune(): ?string
    {
        return $this->nomAncienneCommune;
    }

    public function setNomAncienneCommune(?string $nomAncienneCommune): static
    {
        $this->nomAncienneCommune = $nomAncienneCommune;

        return $this;
    }

    public function getX(): ?string
    {
        return $this->x;
    }

    public function setX(?string $x): static
    {
        $this->x = $x;

        return $this;
    }

    public function getY(): ?string
    {
        return $this->y;
    }

    public function setY(?string $y): static
    {
        $this->y = $y;

        return $this;
    }

    public function getLon(): ?string
    {
        return $this->lon;
    }

    public function setLon(?string $lon): static
    {
        $this->lon = $lon;

        return $this;
    }

    public function getLat(): ?string
    {
        return $this->lat;
    }

    public function setLat(?string $lat): static
    {
        $this->lat = $lat;

        return $this;
    }

    public function getTypePosition(): ?string
    {
        return $this->typePosition;
    }

    public function setTypePosition(?string $typePosition): static
    {
        $this->typePosition = $typePosition;

        return $this;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(?string $alias): static
    {
        $this->alias = $alias;

        return $this;
    }

    public function getNomLd(): ?string
    {
        return $this->nomLd;
    }

    public function setNomLd(?string $nomLd): static
    {
        $this->nomLd = $nomLd;

        return $this;
    }

    public function getLibelleAcheminement(): ?string
    {
        return $this->libelleAcheminement;
    }

    public function setLibelleAcheminement(?string $libelleAcheminement): static
    {
        $this->libelleAcheminement = $libelleAcheminement;

        return $this;
    }

    public function getNomAfnor(): ?string
    {
        return $this->nomAfnor;
    }

    public function setNomAfnor(?string $nomAfnor): static
    {
        $this->nomAfnor = $nomAfnor;

        return $this;
    }

    public function getSourcePosition(): ?string
    {
        return $this->sourcePosition;
    }

    public function setSourcePosition(?string $sourcePosition): static
    {
        $this->sourcePosition = $sourcePosition;

        return $this;
    }

    public function getSourceNomVoie(): ?string
    {
        return $this->sourceNomVoie;
    }

    public function setSourceNomVoie(?string $sourceNomVoie): static
    {
        $this->sourceNomVoie = $sourceNomVoie;

        return $this;
    }

    public function getCertificationCommune(): ?string
    {
        return $this->certificationCommune;
    }

    public function setCertificationCommune(?string $certificationCommune): static
    {
        $this->certificationCommune = $certificationCommune;

        return $this;
    }

    public function getCadParcelles(): ?string
    {
        return $this->cadParcelles;
    }

    public function setCadParcelles(?string $cadParcelles): static
    {
        $this->cadParcelles = $cadParcelles;

        return $this;
    }
}
