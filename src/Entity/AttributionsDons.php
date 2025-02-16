<?php

namespace App\Entity;

use App\Repository\AttributionsDonsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AttributionsDonsRepository::class)]
class AttributionsDons
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $attribution_id = null;

    #[ORM\ManyToOne(inversedBy: 'attributionsDons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Dons $don_id = null;

    #[ORM\OneToOne(inversedBy: 'attributionsDons', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Demandesdons $demande_id = null;

    #[ORM\ManyToOne(inversedBy: 'attributionsDons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $beneficiaire_id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_attribution = null;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAttributionId(): ?int
    {
        return $this->attribution_id;
    }

    public function setAttributionId(int $attribution_id): static
    {
        $this->attribution_id = $attribution_id;

        return $this;
    }

    public function getDonId(): ?dons
    {
        return $this->don_id;
    }

    public function setDonId(?dons $don_id): static
    {
        $this->don_id = $don_id;

        return $this;
    }

    public function getDemandeId(): ?demandesdons
    {
        return $this->demande_id;
    }

    public function setDemandeId(demandesdons $demande_id): static
    {
        $this->demande_id = $demande_id;

        return $this;
    }

    public function getBeneficiaireId(): ?user
    {
        return $this->beneficiaire_id;
    }

    public function setBeneficiaireId(?user $beneficiaire_id): static
    {
        $this->beneficiaire_id = $beneficiaire_id;

        return $this;
    }

    public function getDateAttribution(): ?\DateTimeInterface
    {
        return $this->date_attribution;
    }

    public function setDateAttribution(\DateTimeInterface $date_attribution): static
    {
        $this->date_attribution = $date_attribution;

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
}
