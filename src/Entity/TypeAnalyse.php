<?php

namespace App\Entity;

use App\Repository\TypeAnalyseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeAnalyseRepository::class)]
class TypeAnalyse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_type_analyse = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?float $prix = null;

    /**
     * @var Collection<int, DetailAnalyse>
     */
    #[ORM\OneToMany(targetEntity: DetailAnalyse::class, mappedBy: 'type_Analyse')]
    private Collection $detailAnalyses;

    public function __construct()
    {
        $this->detailAnalyses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdTypeAnalyse(): ?int
    {
        return $this->id_type_analyse;
    }

    public function setIdTypeAnalyse(int $id_type_analyse): static
    {
        $this->id_type_analyse = $id_type_analyse;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

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
            $detailAnalysis->setTypeAnalyse($this);
        }

        return $this;
    }

    public function removeDetailAnalysis(DetailAnalyse $detailAnalysis): static
    {
        if ($this->detailAnalyses->removeElement($detailAnalysis)) {
            // set the owning side to null (unless already changed)
            if ($detailAnalysis->getTypeAnalyse() === $this) {
                $detailAnalysis->setTypeAnalyse(null);
            }
        }

        return $this;
    }
}
