<?php

namespace App\Entity;

use App\Repository\OperationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OperationRepository::class)]
class Operation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_operation = null;

    #[ORM\OneToOne(inversedBy: 'operation', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $id_patient = null;

    #[ORM\OneToOne(inversedBy: 'operation', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $id_medecin = null;

    #[ORM\ManyToOne(inversedBy: 'operations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?salle $id_salle = null;

    #[ORM\Column(length: 255)]
    private ?string $type_operation = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_operation = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $duree = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $commentaire = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdOperation(): ?int
    {
        return $this->id_operation;
    }

    public function setIdOperation(int $id_operation): static
    {
        $this->id_operation = $id_operation;

        return $this;
    }

    public function getIdPatient(): ?user
    {
        return $this->id_patient;
    }

    public function setIdPatient(user $id_patient): static
    {
        $this->id_patient = $id_patient;

        return $this;
    }

    public function getIdMedecin(): ?user
    {
        return $this->id_medecin;
    }

    public function setIdMedecin(user $id_medecin): static
    {
        $this->id_medecin = $id_medecin;

        return $this;
    }

    public function getIdSalle(): ?salle
    {
        return $this->id_salle;
    }

    public function setIdSalle(?salle $id_salle): static
    {
        $this->id_salle = $id_salle;

        return $this;
    }

    public function getTypeOperation(): ?string
    {
        return $this->type_operation;
    }

    public function setTypeOperation(string $type_operation): static
    {
        $this->type_operation = $type_operation;

        return $this;
    }

    public function getDateOperation(): ?\DateTimeInterface
    {
        return $this->date_operation;
    }

    public function setDateOperation(\DateTimeInterface $date_operation): static
    {
        $this->date_operation = $date_operation;

        return $this;
    }

    public function getDuree(): ?\DateTimeInterface
    {
        return $this->duree;
    }

    public function setDuree(\DateTimeInterface $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }
}
