<?php

namespace App\Entity;

use App\Repository\RendezVousAnalyseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RendezVousAnalyseRepository::class)]
class RendezVousAnalyse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_rdv = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_rdv = null;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    #[ORM\ManyToOne(inversedBy: 'rendezVousAnalyses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?disponibiliteanalyse $disponibilite = null;

    #[ORM\ManyToOne(inversedBy: 'rendezVousAnalyses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $patient = null;

    #[ORM\OneToOne(mappedBy: 'rdv', cascade: ['persist', 'remove'])]
    private ?Analyse $analyse = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdRdv(): ?int
    {
        return $this->id_rdv;
    }

    public function setIdRdv(int $id_rdv): static
    {
        $this->id_rdv = $id_rdv;

        return $this;
    }

    public function getDateRdv(): ?\DateTimeInterface
    {
        return $this->date_rdv;
    }

    public function setDateRdv(\DateTimeInterface $date_rdv): static
    {
        $this->date_rdv = $date_rdv;

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

    public function getDisponibilite(): ?disponibiliteanalyse
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(?disponibiliteanalyse $disponibilite): static
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }

    public function getPatient(): ?user
    {
        return $this->patient;
    }

    public function setPatient(?user $patient): static
    {
        $this->patient = $patient;

        return $this;
    }

    public function getAnalyse(): ?Analyse
    {
        return $this->analyse;
    }

    public function setAnalyse(Analyse $analyse): static
    {
        // set the owning side of the relation if necessary
        if ($analyse->getRdv() !== $this) {
            $analyse->setRdv($this);
        }

        $this->analyse = $analyse;

        return $this;
    }
}
