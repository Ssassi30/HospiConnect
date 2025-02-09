<?php

namespace App\Entity;

use App\Repository\AnalyseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnalyseRepository::class)]
class Analyse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_analyse = null;

    #[ORM\Column(length: 255)]
    private ?string $etat = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_prelevement = null;

    #[ORM\OneToOne(inversedBy: 'analyse', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?rendezvousanalyse $rdv = null;

    #[ORM\ManyToOne(inversedBy: 'analyses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $patient = null;

    #[ORM\ManyToOne(inversedBy: 'analyses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $personnel = null;

    /**
     * @var Collection<int, DetailAnalyse>
     */
    #[ORM\OneToMany(targetEntity: DetailAnalyse::class, mappedBy: 'analyse')]
    private Collection $detailAnalyses;

    public function __construct()
    {
        $this->detailAnalyses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdAnalyse(): ?int
    {
        return $this->id_analyse;
    }

    public function setIdAnalyse(int $id_analyse): static
    {
        $this->id_analyse = $id_analyse;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): static
    {
        $this->etat = $etat;

        return $this;
    }

    public function getDatePrelevement(): ?\DateTimeInterface
    {
        return $this->date_prelevement;
    }

    public function setDatePrelevement(\DateTimeInterface $date_prelevement): static
    {
        $this->date_prelevement = $date_prelevement;

        return $this;
    }

    public function getRdv(): ?rendezvousanalyse
    {
        return $this->rdv;
    }

    public function setRdv(rendezvousanalyse $rdv): static
    {
        $this->rdv = $rdv;

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

    public function getPersonnel(): ?user
    {
        return $this->personnel;
    }

    public function setPersonnel(?user $personnel): static
    {
        $this->personnel = $personnel;

        return $this;
    }

    /**
     * @return Collection<int, DetailAnalyse>
     */
    public function getDetailAnalyses(): Collection
    {
        return $this->detailAnalyses;
    }

    public function addDetailAnalysis(DetailAnalyse $detailAnalysis): static
    {
        if (!$this->detailAnalyses->contains($detailAnalysis)) {
            $this->detailAnalyses->add($detailAnalysis);
            $detailAnalysis->setAnalyse($this);
        }

        return $this;
    }

    public function removeDetailAnalysis(DetailAnalyse $detailAnalysis): static
    {
        if ($this->detailAnalyses->removeElement($detailAnalysis)) {
            // set the owning side to null (unless already changed)
            if ($detailAnalysis->getAnalyse() === $this) {
                $detailAnalysis->setAnalyse(null);
            }
        }

        return $this;
    }
}
