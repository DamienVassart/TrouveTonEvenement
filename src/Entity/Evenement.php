<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvenementRepository::class)]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $intitule = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $visuel = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $debut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fin = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $debutInscriptions = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $finInscriptions = null;

    #[ORM\Column]
    private ?int $nbParticipantsMini = null;

    #[ORM\Column]
    private ?int $nbParticipantsMaxi = null;

    #[ORM\Column]
    private ?float $tarifNormal = null;

    #[ORM\Column(nullable: true)]
    private ?float $tarifReduit = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $adresseSaisie = null;

    #[ORM\ManyToOne(inversedBy: 'evenements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CategorieEvenement $categorie = null;

    #[ORM\ManyToOne(inversedBy: 'evenements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?StatutEvenement $statut = null;

    #[ORM\ManyToOne]
    private ?Adresse $adresse = null;

    #[ORM\ManyToOne(inversedBy: 'evenements')]
    private ?Localite $localite = null;

    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'evenement', orphanRemoval: true)]
    private Collection $reservations;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): static
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getVisuel(): ?string
    {
        return $this->visuel;
    }

    public function setVisuel(?string $visuel): static
    {
        $this->visuel = $visuel;

        return $this;
    }

    public function getDebut(): ?\DateTimeInterface
    {
        return $this->debut;
    }

    public function setDebut(\DateTimeInterface $debut): static
    {
        $this->debut = $debut;

        return $this;
    }

    public function getFin(): ?\DateTimeInterface
    {
        return $this->fin;
    }

    public function setFin(\DateTimeInterface $fin): static
    {
        $this->fin = $fin;

        return $this;
    }

    public function getDebutInscriptions(): ?\DateTimeInterface
    {
        return $this->debutInscriptions;
    }

    public function setDebutInscriptions(\DateTimeInterface $debutInscriptions): static
    {
        $this->debutInscriptions = $debutInscriptions;

        return $this;
    }

    public function getFinInscriptions(): ?\DateTimeInterface
    {
        return $this->finInscriptions;
    }

    public function setFinInscriptions(\DateTimeInterface $finInscriptions): static
    {
        $this->finInscriptions = $finInscriptions;

        return $this;
    }

    public function getNbParticipantsMini(): ?int
    {
        return $this->nbParticipantsMini;
    }

    public function setNbParticipantsMini(int $nbParticipantsMini): static
    {
        $this->nbParticipantsMini = $nbParticipantsMini;

        return $this;
    }

    public function getNbParticipantsMaxi(): ?int
    {
        return $this->nbParticipantsMaxi;
    }

    public function setNbParticipantsMaxi(int $nbParticipantsMaxi): static
    {
        $this->nbParticipantsMaxi = $nbParticipantsMaxi;

        return $this;
    }

    public function getTarifNormal(): ?float
    {
        return $this->tarifNormal;
    }

    public function setTarifNormal(float $tarifNormal): static
    {
        $this->tarifNormal = $tarifNormal;

        return $this;
    }

    public function getTarifReduit(): ?float
    {
        return $this->tarifReduit;
    }

    public function setTarifReduit(?float $tarifReduit): static
    {
        $this->tarifReduit = $tarifReduit;

        return $this;
    }

    public function getAdresseSaisie(): ?string
    {
        return $this->adresseSaisie;
    }

    public function setAdresseSaisie(?string $adresseSaisie): static
    {
        $this->adresseSaisie = $adresseSaisie;

        return $this;
    }

    public function getCategorie(): ?CategorieEvenement
    {
        return $this->categorie;
    }

    public function setCategorie(?CategorieEvenement $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getStatut(): ?StatutEvenement
    {
        return $this->statut;
    }

    public function setStatut(?StatutEvenement $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getAdresse(): ?Adresse
    {
        return $this->adresse;
    }

    public function setAdresse(?Adresse $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getLocalite(): ?Localite
    {
        return $this->localite;
    }

    public function setLocalite(?Localite $localite): static
    {
        $this->localite = $localite;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setEvenement($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getEvenement() === $this) {
                $reservation->setEvenement(null);
            }
        }

        return $this;
    }
}
