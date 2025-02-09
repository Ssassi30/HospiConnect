<?php

namespace App\Entity;

use App\Repository\DonsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DonsRepository::class)]
class Dons
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $don_id = null;

    #[ORM\Column(length: 255)]
    private ?string $type_don = null;

    #[ORM\Column]
    private ?float $montant = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'dons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $donateur_id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_don = null;

    #[ORM\Column]
    private ?bool $disponibilite = null;

    /**
     * @var Collection<int, AttributionsDons>
     */
    #[ORM\OneToMany(targetEntity: AttributionsDons::class, mappedBy: 'don_id')]
    private Collection $attributionsDons;

    public function __construct()
    {
        $this->attributionsDons = new ArrayCollection();
    }

    #[ORM\ManyToOne(inversedBy: 'don_id')]
    #[ORM\JoinColumn(nullable: false)]

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDonId(): ?int
    {
        return $this->don_id;
    }

    public function setDonId(int $don_id): static
    {
        $this->don_id = $don_id;

        return $this;
    }

    public function getTypeDon(): ?string
    {
        return $this->type_don;
    }

    public function setTypeDon(string $type_don): static
    {
        $this->type_don = $type_don;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): static
    {
        $this->montant = $montant;

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

    public function getDonateurId(): ?user
    {
        return $this->donateur_id;
    }

    public function setDonateurId(?user $donateur_id): static
    {
        $this->donateur_id = $donateur_id;

        return $this;
    }

    public function getDateDon(): ?\DateTimeInterface
    {
        return $this->date_don;
    }

    public function setDateDon(\DateTimeInterface $date_don): static
    {
        $this->date_don = $date_don;

        return $this;
    }

    public function isDisponibilite(): ?bool
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(bool $disponibilite): static
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }

    /**
     * @return Collection<int, AttributionsDons>
     */
    public function getAttributionsDons(): Collection
    {
        return $this->attributionsDons;
    }

    public function addAttributionsDon(AttributionsDons $attributionsDon): static
    {
        if (!$this->attributionsDons->contains($attributionsDon)) {
            $this->attributionsDons->add($attributionsDon);
            $attributionsDon->setDonId($this);
        }

        return $this;
    }

    public function removeAttributionsDon(AttributionsDons $attributionsDon): static
    {
        if ($this->attributionsDons->removeElement($attributionsDon)) {
            // set the owning side to null (unless already changed)
            if ($attributionsDon->getDonId() === $this) {
                $attributionsDon->setDonId(null);
            }
        }

        return $this;
    }


}
