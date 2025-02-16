<?php

namespace App\Entity;

use App\Repository\DemandesDonsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DemandesDonsRepository::class)]
class DemandesDons
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $demande_id = null;

    #[ORM\ManyToOne(inversedBy: 'demandesDons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $patient_id = null;

    #[ORM\Column(length: 255)]
    private ?string $type_besoin = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $details = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_demande = null;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    #[ORM\OneToOne(mappedBy: 'demande_id', cascade: ['persist', 'remove'])]
    private ?AttributionsDons $attributionsDons = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDemandeId(): ?int
    {
        return $this->demande_id;
    }

    public function setDemandeId(int $demande_id): static
    {
        $this->demande_id = $demande_id;

        return $this;
    }

    public function getPatientId(): ?user
    {
        return $this->patient_id;
    }

    public function setPatientId(?user $patient_id): static
    {
        $this->patient_id = $patient_id;

        return $this;
    }

    public function getTypeBesoin(): ?string
    {
        return $this->type_besoin;
    }

    public function setTypeBesoin(string $type_besoin): static
    {
        $this->type_besoin = $type_besoin;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(string $details): static
    {
        $this->details = $details;

        return $this;
    }

    public function getDateDemande(): ?\DateTimeInterface
    {
        return $this->date_demande;
    }

    public function setDateDemande(\DateTimeInterface $date_demande): static
    {
        $this->date_demande = $date_demande;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getAttributionsDons(): ?AttributionsDons
    {
        return $this->attributionsDons;
    }

    public function setAttributionsDons(AttributionsDons $attributionsDons): static
    {
        // set the owning side of the relation if necessary
        if ($attributionsDons->getDemandeId() !== $this) {
            $attributionsDons->setDemandeId($this);
        }

        $this->attributionsDons = $attributionsDons;

        return $this;
    }
}
