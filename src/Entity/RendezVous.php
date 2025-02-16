<?php

namespace App\Entity;

use App\Repository\RendezVousRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RendezVousRepository::class)]
class RendezVous
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_rendezvous = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Salle $id_patient = null;

    #[ORM\Column]
    private ?int $id_medecin = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Salle $id_salle = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_rendezvous = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heure_rendezvous = null;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdRendezvous(): ?int
    {
        return $this->id_rendezvous;
    }

    public function setIdRendezvous(int $id_rendezvous): static
    {
        $this->id_rendezvous = $id_rendezvous;

        return $this;
    }

    public function getIdPatient(): ?salle
    {
        return $this->id_patient;
    }

    public function setIdPatient(?salle $id_patient): static
    {
        $this->id_patient = $id_patient;

        return $this;
    }

    public function getIdMedecin(): ?int
    {
        return $this->id_medecin;
    }

    public function setIdMedecin(int $id_medecin): static
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

    public function getDateRendezvous(): ?\DateTimeInterface
    {
        return $this->date_rendezvous;
    }

    public function setDateRendezvous(\DateTimeInterface $date_rendezvous): static
    {
        $this->date_rendezvous = $date_rendezvous;

        return $this;
    }

    public function getHeureRendezvous(): ?\DateTimeInterface
    {
        return $this->heure_rendezvous;
    }

    public function setHeureRendezvous(\DateTimeInterface $heure_rendezvous): static
    {
        $this->heure_rendezvous = $heure_rendezvous;

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
