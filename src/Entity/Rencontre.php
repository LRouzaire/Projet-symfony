<?php

namespace App\Entity;

use App\Repository\RencontreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RencontreRepository::class)]
class Rencontre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateMAtch = null;

    #[ORM\Column(length: 100)]
    private ?string $lieu = null;

    #[ORM\Column(nullable: true)]
    private ?int $scoreDomicile = null;

    #[ORM\Column(nullable: true)]
    private ?int $scoreExterieur = null;

    #[ORM\ManyToOne(inversedBy: 'rencontres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Competition $competition = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Equipe $equipeDomicile = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Equipe $equipeExterieure = null;

    /**
     * @var Collection<int, Performance>
     */
    #[ORM\OneToMany(targetEntity: Performance::class, mappedBy: 'rencontre')]
    private Collection $performances;

    public function __construct()
    {
        $this->performances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateMAtch(): ?\DateTime
    {
        return $this->dateMAtch;
    }

    public function setDateMAtch(\DateTime $dateMAtch): static
    {
        $this->dateMAtch = $dateMAtch;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): static
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getScoreDomicile(): ?int
    {
        return $this->scoreDomicile;
    }

    public function setScoreDomicile(?int $scoreDomicile): static
    {
        $this->scoreDomicile = $scoreDomicile;

        return $this;
    }

    public function getScoreExterieur(): ?int
    {
        return $this->scoreExterieur;
    }

    public function setScoreExterieur(?int $scoreExterieur): static
    {
        $this->scoreExterieur = $scoreExterieur;

        return $this;
    }

    public function getCompetition(): ?Competition
    {
        return $this->competition;
    }

    public function setCompetition(?Competition $competition): static
    {
        $this->competition = $competition;

        return $this;
    }

    public function getEquipeDomicile(): ?Equipe
    {
        return $this->equipeDomicile;
    }

    public function setEquipeDomicile(?Equipe $equipeDomicile): static
    {
        $this->equipeDomicile = $equipeDomicile;

        return $this;
    }

    public function getEquipeExterieure(): ?Equipe
    {
        return $this->equipeExterieure;
    }

    public function setEquipeExterieure(?Equipe $equipeExterieure): static
    {
        $this->equipeExterieure = $equipeExterieure;

        return $this;
    }

    /**
     * @return Collection<int, Performance>
     */
    public function getPerformances(): Collection
    {
        return $this->performances;
    }

    public function addPerformance(Performance $performance): static
    {
        if (!$this->performances->contains($performance)) {
            $this->performances->add($performance);
            $performance->setRencontre($this);
        }

        return $this;
    }

    public function removePerformance(Performance $performance): static
    {
        if ($this->performances->removeElement($performance)) {
            // set the owning side to null (unless already changed)
            if ($performance->getRencontre() === $this) {
                $performance->setRencontre(null);
            }
        }

        return $this;
    }
}
