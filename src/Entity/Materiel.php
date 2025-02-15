<?php

namespace App\Entity;

use App\Repository\MaterielRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaterielRepository::class)]
class Materiel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_materiel = null;


    #[ORM\Column]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $categorie = null;

    #[ORM\Column(length: 255)]
    private ?string $etat = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\Column(length: 255)]
    private ?string $emplacement = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_ajout = null;

    /**
     * @var Collection<int, MouvementsStock>
     */
    #[ORM\OneToMany(targetEntity: MouvementsStock::class, mappedBy: 'id_materiel')]
    private Collection $mouvementsStocks;

    public function __construct()
    {
        $this->mouvementsStocks = new ArrayCollection();
    }
    





    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMateriel(): ?int
    {
        return $this->id_materiel;
    }

    public function setIdMateriel(int $id_materiel): static
    {
        $this->id_materiel = $id_materiel;

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

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): static
    {
        $this->categorie = $categorie;

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

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getEmplacement(): ?string
    {
        return $this->emplacement;
    }

    public function setEmplacement(string $emplacement): static
    {
        $this->emplacement = $emplacement;

        return $this;
    }

    public function getDateAjout(): ?\DateTimeInterface
    {
        return $this->date_ajout;
    }

    public function setDateAjout(\DateTimeInterface $date_ajout): static
    {
        $this->date_ajout = $date_ajout;

        return $this;
    }

    /**
     * @return Collection<int, MouvementsStock>
     */
    public function getMouvementsStocks(): Collection
    {
        return $this->mouvementsStocks;
    }

    public function addMouvementsStock(MouvementsStock $mouvementsStock): static
    {
        if (!$this->mouvementsStocks->contains($mouvementsStock)) {
            $this->mouvementsStocks->add($mouvementsStock);
            $mouvementsStock->setIdMateriel($this);
        }

        return $this;
    }

    public function removeMouvementsStock(MouvementsStock $mouvementsStock): static
    {
        if ($this->mouvementsStocks->removeElement($mouvementsStock)) {
            // set the owning side to null (unless already changed)
            if ($mouvementsStock->getIdMateriel() === $this) {
                $mouvementsStock->setIdMateriel(null);
            }
        }

        return $this;
    }




}
