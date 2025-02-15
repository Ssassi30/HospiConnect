<?php

namespace App\Entity;

use App\Repository\DisponibiliteAnalyseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DisponibiliteAnalyseRepository::class)]
class DisponibiliteAnalyse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_dispo = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_dispo = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heure_debut = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heure_fin = null;

    #[ORM\Column]
    private ?int $nb_places = null;

    /**
     * @var Collection<int, RendezVousAnalyse>
     */
    #[ORM\OneToMany(targetEntity: RendezVousAnalyse::class, mappedBy: 'disponibilite')]
    private Collection $rendezVousAnalyses;

    public function __construct()
    {
        $this->rendezVousAnalyses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdDispo(): ?int
    {
        return $this->id_dispo;
    }

    public function setIdDispo(int $id_dispo): static
    {
        $this->id_dispo = $id_dispo;

        return $this;
    }

    public function getDateDispo(): ?\DateTimeInterface
    {
        return $this->date_dispo;
    }

    public function setDateDispo(\DateTimeInterface $date_dispo): static
    {
        $this->date_dispo = $date_dispo;

        return $this;
    }

    public function getHeureDebut(): ?\DateTimeInterface
    {
        return $this->heure_debut;
    }

    public function setHeureDebut(\DateTimeInterface $heure_debut): static
    {
        $this->heure_debut = $heure_debut;

        return $this;
    }

    public function getHeureFin(): ?\DateTimeInterface
    {
        return $this->heure_fin;
    }

    public function setHeureFin(\DateTimeInterface $heure_fin): static
    {
        $this->heure_fin = $heure_fin;

        return $this;
    }

    public function getNbPlaces(): ?int
    {
        return $this->nb_places;
    }

    public function setNbPlaces(int $nb_places): static
    {
        $this->nb_places = $nb_places;

        return $this;
    }

    /**
     * @return Collection<int, RendezVousAnalyse>
     */
    public function getRendezVousAnalyses(): Collection
    {
        return $this->rendezVousAnalyses;
    }

    public function addRendezVousAnalysis(RendezVousAnalyse $rendezVousAnalysis): static
    {
        if (!$this->rendezVousAnalyses->contains($rendezVousAnalysis)) {
            $this->rendezVousAnalyses->add($rendezVousAnalysis);
            $rendezVousAnalysis->setDisponibilite($this);
        }

        return $this;
    }

    public function removeRendezVousAnalysis(RendezVousAnalyse $rendezVousAnalysis): static
    {
        if ($this->rendezVousAnalyses->removeElement($rendezVousAnalysis)) {
            // set the owning side to null (unless already changed)
            if ($rendezVousAnalysis->getDisponibilite() === $this) {
                $rendezVousAnalysis->setDisponibilite(null);
            }
        }

        return $this;
    }
}
