<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Assert\NotBlank(message: "Le nom est obligatoire.")]
    #[Assert\Length(min: 3, max: 50, minMessage: "Le nom doit comporter au moins 3 caractères.", maxMessage: "Le nom ne doit pas dépasser 50 caractères.")]
    private ?string $nom = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Assert\NotBlank(message: "Le prénom est obligatoire.")]
    private ?string $prenom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateN = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message: "L'email est obligatoire.")]
    #[Assert\Email(message: "L'email {{ value }} n'est pas valide.")]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank]
    private ?string $mdp = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank]
    private ?\DateTimeInterface $date_c = null;

    #[ORM\Column(length: 20, nullable: true)]
    #[Assert\NotBlank]
    private ?string $statut_compte = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank]
    private ?string $empreinte = null;

    #[ORM\Column(length: 30, nullable: true)]
    #[Assert\NotBlank]
    private ?string $role = null;

    #[ORM\Column(type: 'time', nullable: true)]
    #[Assert\NotBlank]
    private ?\DateTime $inactivite = null;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private ?string $groupeSanguin = null;

    #[ORM\Column(length: 9, nullable: true)]
    #[Assert\NotBlank]
    private ?string $tel = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresse = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $zipcode = null;


    #[ORM\Column(length: 20, nullable: true)]
    private ?string $gouvernorat = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $sexe = null;

    #[ORM\Column(type: "decimal", precision: 10, scale: 3, nullable: true)]
    private ?float $poids = null;

    #[ORM\Column(type: "decimal", precision: 10, scale: 3, nullable: true)]
    private ?float $taille = null;

    #[ORM\Column(type: "decimal", precision: 10, scale: 3, nullable: true)]
    private ?float $imc = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $img = null;

    /**
     * @var Collection<int, Dons>
     */
    #[ORM\OneToMany(targetEntity: Dons::class, mappedBy: 'donateur_id', orphanRemoval: true)]
    private Collection $dons;


    /**
     * @var Collection<int, DemandesDons>
     */
    #[ORM\OneToMany(targetEntity: DemandesDons::class, mappedBy: 'patient_id')]
    private Collection $demandesDons;

    /**
     * @var Collection<int, AttributionsDons>
     */
    #[ORM\OneToMany(targetEntity: AttributionsDons::class, mappedBy: 'beneficiaire_id')]
    private Collection $attributionsDons;

    /**
     * @var Collection<int, RendezVousAnalyse>
     */
    #[ORM\OneToMany(targetEntity: RendezVousAnalyse::class, mappedBy: 'patient')]
    private Collection $rendezVousAnalyses;

    /**
     * @var Collection<int, Analyse>
     */
    #[ORM\OneToMany(targetEntity: Analyse::class, mappedBy: 'patient')]
    private Collection $analyses;

    #[ORM\OneToOne(mappedBy: 'id_patient', cascade: ['persist', 'remove'])]
    private ?Operation $operation = null;

    /**
     * @var Collection<int, InterventionUrgence>
     */
    #[ORM\OneToMany(targetEntity: InterventionUrgence::class, mappedBy: 'id_patient')]
    private Collection $interventionUrgences;

    /**
     * @var Collection<int, MouvementsStock>
     */
    #[ORM\OneToMany(targetEntity: MouvementsStock::class, mappedBy: 'id_personnel')]
    private Collection $mouvementsStocks;

    /**
     * @var Collection<int, Consultation>
     */
    #[ORM\OneToMany(targetEntity: Consultation::class, mappedBy: 'id_patient')]
    private Collection $consultations;

    public function __construct()
    {
        $this->dons = new ArrayCollection();
        $this->demandesDons = new ArrayCollection();
        $this->attributionsDons = new ArrayCollection();
        $this->rendezVousAnalyses = new ArrayCollection();
        $this->analyses = new ArrayCollection();
        $this->interventionUrgences = new ArrayCollection();
        $this->mouvementsStocks = new ArrayCollection();
        $this->consultations = new ArrayCollection();
    }



    public function getImc(): ?string
    {
        return $this->imc;
    }

    public function setImc(?string $imc): self
    {
        $this->imc = $imc;
        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(?string $img): self
    {
        $this->img = $img;
        return $this;
    }


    public function gettaille(): ?string
    {
        return $this->taille;
    }



    public function settaille(?string $taille): self
    {
        $this->taille = $taille;
        return $this;
    }

    public function getpoids(): ?string
    {
        return $this->poids;
    }

    public function setpoids(?string $poids): self
    {
        $this->poids = $poids;
        return $this;
    }
    public function getsexe(): ?string
    {
        return $this->sexe;
    }

    public function setsexe(?string $sexe): self
    {
        $this->sexe = $sexe;
        return $this;
    }

    public function getgouvernorat(): ?string
    {
        return $this->gouvernorat;
    }

    public function setgouvernorat(?string $gouvernorat): self
    {
        $this->gouvernorat = $gouvernorat;
        return $this;
    }

    public function getGroupeSanguin(): ?string
    {
        return $this->groupeSanguin;
    }

    // ✅ Setter (si nécessaire)
    public function setGroupeSanguin(?string $groupeSanguin): self
    {
        $this->groupeSanguin = $groupeSanguin;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;
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
    public function getzipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setzipcode(string $zipcode): static
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function gettel(): ?string
    {
        return $this->tel;
    }


    public function seTtel(string $tel): static
    {
        $this->tel = $tel;

        return $this;
    }

    public function getinactivite(): ?string
    {
        if ($this->inactivite instanceof \DateTime) {
            return $this->inactivite->format('Y-m-d H:i:s');  // Ou tout autre format de date
        }

        return null;  // ou une valeur par défaut si inactivite est null
    }

    public function setInactivite(\DateTime $inactivite): static
    {
        $this->inactivite = $inactivite;

        return $this;
    }


    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateN(): ?string
    {
        return $this->date_c ? $this->date_c->format('Y-m-d') : null;
    }

    // ✅ Setter pour dateN (si besoin)
    public function setDateN(?\DateTimeInterface $dateN): self
    {
        $this->dateN = $dateN;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }


    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getstatut_compte(): ?string
    {
        return $this->statut_compte;
    }

    public function setstatut_compte(string $statut_compte): static
    {
        $this->statut_compte = $statut_compte;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): static
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getDateC(): ?\DateTimeInterface
    {
        return $this->date_c;
    }

    public function setDateC(\DateTimeInterface $date_c): static
    {
        $this->date_c = $date_c;

        return $this;
    }

    public function getStatutCompte(): ?string
    {
        return $this->statut_compte;
    }

    public function setStatutCompte(string $statut_compte): static
    {
        $this->statut_compte = $statut_compte;

        return $this;
    }

    public function getEmpreinte(): ?string
    {
        return $this->empreinte;
    }

    public function setEmpreinte(string $empreinte): static
    {
        $this->empreinte = $empreinte;

        return $this;
    }

    /**
     * @return Collection<int, Dons>
     */
    public function getDons(): Collection
    {
        return $this->dons;
    }

    public function addDon(Dons $don): static
    {
        if (!$this->dons->contains($don)) {
            $this->dons->add($don);
            $don->setDonateurId($this);
        }

        return $this;
    }

    public function removeDon(Dons $don): static
    {
        if ($this->dons->removeElement($don)) {
            // set the owning side to null (unless already changed)
            if ($don->getDonateurId() === $this) {
                $don->setDonateurId(null);
            }
        }

        return $this;
    }





    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @return Collection<int, DemandesDons>
     */
    public function getDemandesDons(): Collection
    {
        return $this->demandesDons;
    }

    public function addDemandesDon(DemandesDons $demandesDon): static
    {
        if (!$this->demandesDons->contains($demandesDon)) {
            $this->demandesDons->add($demandesDon);
            $demandesDon->setPatientId($this);
        }

        return $this;
    }

    public function removeDemandesDon(DemandesDons $demandesDon): static
    {
        if ($this->demandesDons->removeElement($demandesDon)) {
            // set the owning side to null (unless already changed)
            if ($demandesDon->getPatientId() === $this) {
                $demandesDon->setPatientId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AttributionsDons>
     */
    public function getAttributionsDons(): Collection
    {
        return $this->attributionsDons;
    }

    public function addAttributionsDon(AttributionsDons $attributionsDon): static
    {
        if (!$this->attributionsDons->contains($attributionsDon)) {
            $this->attributionsDons->add($attributionsDon);
            $attributionsDon->setBeneficiaireId($this);
        }

        return $this;
    }

    public function removeAttributionsDon(AttributionsDons $attributionsDon): static
    {
        if ($this->attributionsDons->removeElement($attributionsDon)) {
            // set the owning side to null (unless already changed)
            if ($attributionsDon->getBeneficiaireId() === $this) {
                $attributionsDon->setBeneficiaireId(null);
            }
        }

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
            $rendezVousAnalysis->setPatient($this);
        }

        return $this;
    }

    public function removeRendezVousAnalysis(RendezVousAnalyse $rendezVousAnalysis): static
    {
        if ($this->rendezVousAnalyses->removeElement($rendezVousAnalysis)) {
            // set the owning side to null (unless already changed)
            if ($rendezVousAnalysis->getPatient() === $this) {
                $rendezVousAnalysis->setPatient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Analyse>
     */
    public function getAnalyses(): Collection
    {
        return $this->analyses;
    }

    public function addAnalysis(Analyse $analysis): static
    {
        if (!$this->analyses->contains($analysis)) {
            $this->analyses->add($analysis);
            $analysis->setPatient($this);
        }

        return $this;
    }

    public function removeAnalysis(Analyse $analysis): static
    {
        if ($this->analyses->removeElement($analysis)) {
            // set the owning side to null (unless already changed)
            if ($analysis->getPatient() === $this) {
                $analysis->setPatient(null);
            }
        }

        return $this;
    }

    public function getOperation(): ?Operation
    {
        return $this->operation;
    }

    public function setOperation(Operation $operation): static
    {
        // set the owning side of the relation if necessary
        if ($operation->getIdPatient() !== $this) {
            $operation->setIdPatient($this);
        }

        $this->operation = $operation;

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
            $interventionUrgence->setIdPatient($this);
        }

        return $this;
    }

    public function removeInterventionUrgence(InterventionUrgence $interventionUrgence): static
    {
        if ($this->interventionUrgences->removeElement($interventionUrgence)) {
            // set the owning side to null (unless already changed)
            if ($interventionUrgence->getIdPatient() === $this) {
                $interventionUrgence->setIdPatient(null);
            }
        }

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
            $mouvementsStock->setIdPersonnel($this);
        }

        return $this;
    }

    public function removeMouvementsStock(MouvementsStock $mouvementsStock): static
    {
        if ($this->mouvementsStocks->removeElement($mouvementsStock)) {
            // set the owning side to null (unless already changed)
            if ($mouvementsStock->getIdPersonnel() === $this) {
                $mouvementsStock->setIdPersonnel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Consultation>
     */
    public function getConsultations(): Collection
    {
        return $this->consultations;
    }

    public function addConsultation(Consultation $consultation): static
    {
        if (!$this->consultations->contains($consultation)) {
            $this->consultations->add($consultation);
            $consultation->setIdPatient($this);
        }

        return $this;
    }

    public function removeConsultation(Consultation $consultation): static
    {
        if ($this->consultations->removeElement($consultation)) {
            // set the owning side to null (unless already changed)
            if ($consultation->getIdPatient() === $this) {
                $consultation->setIdPatient(null);
            }
        }

        return $this;
    }
}
