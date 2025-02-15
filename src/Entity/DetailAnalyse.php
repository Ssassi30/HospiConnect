<?php

namespace App\Entity;

use App\Repository\DetailAnalyseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetailAnalyseRepository::class)]
class DetailAnalyse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $resultat = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_resultat = null;

    #[ORM\ManyToOne(inversedBy: 'detailAnalyses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Analyse $analyse = null;

    #[ORM\ManyToOne(inversedBy: 'detailAnalyses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeAnalyse $type_Analyse = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResultat(): ?string
    {
        return $this->resultat;
    }

    public function setResultat(string $resultat): static
    {
        $this->resultat = $resultat;

        return $this;
    }

    public function getDateResultat(): ?\DateTimeInterface
    {
        return $this->date_resultat;
    }

    public function setDateResultat(\DateTimeInterface $date_resultat): static
    {
        $this->date_resultat = $date_resultat;

        return $this;
    }

    public function getAnalyse(): ?Analyse
    {
        return $this->analyse;
    }

    public function setAnalyse(?Analyse $analyse): static
    {
        $this->analyse = $analyse;

        return $this;
    }

    public function getTypeAnalyse(): ?TypeAnalyse
    {
        return $this->type_Analyse;
    }

    public function setTypeAnalyse(?TypeAnalyse $type_Analyse): static
    {
        $this->type_Analyse = $type_Analyse;

        return $this;
    }
}
