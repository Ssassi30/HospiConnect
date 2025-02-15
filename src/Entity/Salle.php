<?php

namespace App\Entity;

use App\Repository\SalleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SalleRepository::class)]
class Salle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;



    #[ORM\Column(length: 255)]
    private ?string $nom_salle = null;

    #[ORM\Column(length: 255)]
    private ?string $type_salle = null;

    #[ORM\Column]
    private ?bool $disponibilite = null;

    /**
     * @var Collection<int, Operation>
     */
    #[ORM\OneToMany(targetEntity: Operation::class, mappedBy: 'id_salle')]
    private Collection $operations;

    /**
     * @var Collection<int, InterventionUrgence>
     */
    #[ORM\OneToMany(targetEntity: InterventionUrgence::class, mappedBy: 'id_salle')]
    private Collection $interventionUrgences;

    public function __construct()
    {
        $this->operations = new ArrayCollection();
        $this->interventionUrgences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }



    public function getNomSalle(): ?string
    {
        return $this->nom_salle;
    }

    public function setNomSalle(string $nom_salle): static
    {
        $this->nom_salle = $nom_salle;

        return $this;
    }

    public function getTypeSalle(): ?string
    {
        return $this->type_salle;
    }

    public function setTypeSalle(string $type_salle): static
    {
        $this->type_salle = $type_salle;

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
     * @return Collection<int, Operation>
     */
    public function getOperations(): Collection
    {
        return $this->operations;
    }

    public function addOperation(Operation $operation): static
    {
        if (!$this->operations->contains($operation)) {
            $this->operations->add($operation);
            $operation->setIdSalle($this);
        }

        return $this;
    }

    public function removeOperation(Operation $operation): static
    {
        if ($this->operations->removeElement($operation)) {
            // set the owning side to null (unless already changed)
            if ($operation->getIdSalle() === $this) {
                $operation->setIdSalle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, InterventionUrgence>
     */
    public function getInterventionUrgences(): Collection
    {
        return $this->interventionUrgences;
    }

    public function addInterventionUrgence(InterventionUrgence $interventionUrgence): static
    {
        if (!$this->interventionUrgences->contains($interventionUrgence)) {
            $this->interventionUrgences->add($interventionUrgence);
            $interventionUrgence->setIdSalle($this);
        }

        return $this;
    }

    public function removeInterventionUrgence(InterventionUrgence $interventionUrgence): static
    {
        if ($this->interventionUrgences->removeElement($interventionUrgence)) {
            // set the owning side to null (unless already changed)
            if ($interventionUrgence->getIdSalle() === $this) {
                $interventionUrgence->setIdSalle(null);
            }
        }

        return $this;
    }
}
