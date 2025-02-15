<?php

namespace App\Entity;

use App\Repository\MouvementsStockRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MouvementsStockRepository::class)]
class MouvementsStock
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_mouvement = null;

    #[ORM\ManyToOne(inversedBy: 'mouvementsStocks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Materiel $id_materiel = null;

    #[ORM\ManyToOne(inversedBy: 'mouvementsStocks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $id_personnel = null;

    #[ORM\Column]
    private ?int $qunatite = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_mouvement = null;

    #[ORM\Column(length: 255)]
    private ?string $motif = null;

    #[ORM\Column(length: 255)]
    private ?string $TypeMouvement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMouvement(): ?int
    {
        return $this->id_mouvement;
    }

    public function setIdMouvement(int $id_mouvement): static
    {
        $this->id_mouvement = $id_mouvement;

        return $this;
    }

    public function getIdMateriel(): ?Materiel
    {
        return $this->id_materiel;
    }

    public function setIdMateriel(?Materiel $id_materiel): static
    {
        $this->id_materiel = $id_materiel;

        return $this;
    }

    public function getIdPersonnel(): ?User
    {
        return $this->id_personnel;
    }

    public function setIdPersonnel(?User $id_personnel): static
    {
        $this->id_personnel = $id_personnel;

        return $this;
    }

    public function getQunatite(): ?int
    {
        return $this->qunatite;
    }

    public function setQunatite(int $qunatite): static
    {
        $this->qunatite = $qunatite;

        return $this;
    }

    public function getDateMouvement(): ?\DateTimeInterface
    {
        return $this->date_mouvement;
    }

    public function setDateMouvement(\DateTimeInterface $date_mouvement): static
    {
        $this->date_mouvement = $date_mouvement;

        return $this;
    }

    public function getMotif(): ?string
    {
        return $this->motif;
    }

    public function setMotif(string $motif): static
    {
        $this->motif = $motif;

        return $this;
    }

    public function getTypeMouvement(): ?string
    {
        return $this->TypeMouvement;
    }

    public function setTypeMouvement(string $TypeMouvement): static
    {
        $this->TypeMouvement = $TypeMouvement;

        return $this;
    }
}
