<?php

namespace App\Entity;

use App\Repository\InterventionUrgenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InterventionUrgenceRepository::class)]
class InterventionUrgence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_intervention = null;

    #[ORM\ManyToOne(inversedBy: 'interventionUrgences')]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $id_patient = null;

    /**
     * @var Collection<int, user>
     */
    #[ORM\ManyToMany(targetEntity: user::class, inversedBy: 'interventionUrgences')]
    private Collection $id_medecin;

    #[ORM\ManyToOne(inversedBy: 'interventionUrgences')]
    #[ORM\JoinColumn(nullable: false)]
    private ?salle $id_salle = null;

    #[ORM\Column(length: 255)]
    private ?string $type_intervention = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_intervention = null;

    #[ORM\Column(length: 255)]
    private ?string $garvite = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $commentaires = null;

    public function __construct()
    {
        $this->id_medecin = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdIntervention(): ?int
    {
        return $this->id_intervention;
    }

    public function setIdIntervention(int $id_intervention): static
    {
        $this->id_intervention = $id_intervention;

        return $this;
    }

    public function getIdPatient(): ?user
    {
        return $this->id_patient;
    }

    public function setIdPatient(?user $id_patient): static
    {
        $this->id_patient = $id_patient;

        return $this;
    }

    /**
     * @return Collection<int, user>
     */
    public function getIdMedecin(): Collection
    {
        return $this->id_medecin;
    }

    public function addIdMedecin(user $idMedecin): static
    {
        if (!$this->id_medecin->contains($idMedecin)) {
            $this->id_medecin->add($idMedecin);
        }

        return $this;
    }

    public function removeIdMedecin(user $idMedecin): static
    {
        $this->id_medecin->removeElement($idMedecin);

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

    public function getTypeIntervention(): ?string
    {
        return $this->type_intervention;
    }

    public function setTypeIntervention(string $type_intervention): static
    {
        $this->type_intervention = $type_intervention;

        return $this;
    }

    public function getDateIntervention(): ?\DateTimeInterface
    {
        return $this->date_intervention;
    }

    public function setDateIntervention(\DateTimeInterface $date_intervention): static
    {
        $this->date_intervention = $date_intervention;

        return $this;
    }

    public function getGarvite(): ?string
    {
        return $this->garvite;
    }

    public function setGarvite(string $garvite): static
    {
        $this->garvite = $garvite;

        return $this;
    }

    public function getCommentaires(): ?string
    {
        return $this->commentaires;
    }

    public function setCommentaires(string $commentaires): static
    {
        $this->commentaires = $commentaires;

        return $this;
    }
}
