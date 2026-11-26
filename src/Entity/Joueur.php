<?php

namespace App\Entity;

use App\Repository\JoueurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JoueurRepository::class)]
class Joueur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateNaissance = null;

    #[ORM\Column]
    private ?int $numMaillot = null;

    #[ORM\Column(length: 50)]
    private ?string $poste = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur = null;

    #[ORM\ManyToOne(inversedBy: 'joueurs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Equipe $equipe = null;

    /**
     * @var Collection<int, Objectif>
     */
    #[ORM\OneToMany(targetEntity: Objectif::class, mappedBy: 'joueur')]
    private Collection $objetcifs;

    /**
     * @var Collection<int, Performance>
     */
    #[ORM\OneToMany(targetEntity: Performance::class, mappedBy: 'joueur')]
    private Collection $performances;

    public function __construct()
    {
        $this->objetcifs = new ArrayCollection();
        $this->performances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateNaissance(): ?\DateTime
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTime $dateNaissance): static
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getNumMaillot(): ?int
    {
        return $this->numMaillot;
    }

    public function setNumMaillot(int $numMaillot): static
    {
        $this->numMaillot = $numMaillot;

        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(string $poste): static
    {
        $this->poste = $poste;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(Utilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getEquipe(): ?Equipe
    {
        return $this->equipe;
    }

    public function setEquipe(?Equipe $equipe): static
    {
        $this->equipe = $equipe;

        return $this;
    }

    /**
     * @return Collection<int, Objectif>
     */
    public function getObjetcifs(): Collection
    {
        return $this->objetcifs;
    }

    public function addObjetcif(Objectif $objetcif): static
    {
        if (!$this->objetcifs->contains($objetcif)) {
            $this->objetcifs->add($objetcif);
            $objetcif->setJoueur($this);
        }

        return $this;
    }

    public function removeObjetcif(Objectif $objetcif): static
    {
        if ($this->objetcifs->removeElement($objetcif)) {
            // set the owning side to null (unless already changed)
            if ($objetcif->getJoueur() === $this) {
                $objetcif->setJoueur(null);
            }
        }

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
            $performance->setJoueur($this);
        }

        return $this;
    }

    public function removePerformance(Performance $performance): static
    {
        if ($this->performances->removeElement($performance)) {
            // set the owning side to null (unless already changed)
            if ($performance->getJoueur() === $this) {
                $performance->setJoueur(null);
            }
        }

        return $this;
    }
}
