<?php

namespace App\Entity;

use App\Repository\ConsultationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConsultationRepository::class)]
class Consultation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_consultation = null;

    #[ORM\ManyToOne(inversedBy: 'consultations')]
    private ?Bureau $id_bureau = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Reservation $id_reservation = null;

    #[ORM\Column(length: 255)]
    private ?string $type_consultation = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_consultation = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $note = null;

    #[ORM\ManyToOne(inversedBy: 'consultations')]
    private ?User $id_patient = null;

    #[ORM\ManyToOne(inversedBy: 'consultations')]
    private ?User $id_medecin = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdConsultation(): ?int
    {
        return $this->id_consultation;
    }

    public function setIdConsultation(int $id_consultation): static
    {
        $this->id_consultation = $id_consultation;

        return $this;
    }

    public function getIdBureau(): ?Bureau
    {
        return $this->id_bureau;
    }

    public function setIdBureau(?Bureau $id_bureau): static
    {
        $this->id_bureau = $id_bureau;

        return $this;
    }

    public function getIdReservation(): ?Reservation
    {
        return $this->id_reservation;
    }

    public function setIdReservation(?Reservation $id_reservation): static
    {
        $this->id_reservation = $id_reservation;

        return $this;
    }

    public function getTypeConsultation(): ?string
    {
        return $this->type_consultation;
    }

    public function setTypeConsultation(string $type_consultation): static
    {
        $this->type_consultation = $type_consultation;

        return $this;
    }

    public function getDateConsultation(): ?\DateTimeInterface
    {
        return $this->date_consultation;
    }

    public function setDateConsultation(\DateTimeInterface $date_consultation): static
    {
        $this->date_consultation = $date_consultation;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(string $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getIdPatient(): ?User
    {
        return $this->id_patient;
    }

    public function setIdPatient(?User $id_patient): static
    {
        $this->id_patient = $id_patient;

        return $this;
    }

    public function getIdMedecin(): ?User
    {
        return $this->id_medecin;
    }

    public function setIdMedecin(?User $id_medecin): static
    {
        $this->id_medecin = $id_medecin;

        return $this;
    }
}
