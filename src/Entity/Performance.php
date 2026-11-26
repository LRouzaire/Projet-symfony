<?php

namespace App\Entity;

use App\Repository\PerformanceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PerformanceRepository::class)]
class Performance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $points = null;

    #[ORM\Column]
    private ?int $rebonds = null;

    #[ORM\Column]
    private ?int $passesDecisives = null;

    #[ORM\Column]
    private ?int $contres = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $datePerformance = null;

    #[ORM\ManyToOne(inversedBy: 'performances')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Joueur $joueur = null;

    #[ORM\ManyToOne(inversedBy: 'performances')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Rencontre $rencontre = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): static
    {
        $this->points = $points;

        return $this;
    }

    public function getRebonds(): ?int
    {
        return $this->rebonds;
    }

    public function setRebonds(int $rebonds): static
    {
        $this->rebonds = $rebonds;

        return $this;
    }

    public function getPassesDecisives(): ?int
    {
        return $this->passesDecisives;
    }

    public function setPassesDecisives(int $passesDecisives): static
    {
        $this->passesDecisives = $passesDecisives;

        return $this;
    }

    public function getContres(): ?int
    {
        return $this->contres;
    }

    public function setContres(int $contres): static
    {
        $this->contres = $contres;

        return $this;
    }

    public function getDatePerformance(): ?\DateTime
    {
        return $this->datePerformance;
    }

    public function setDatePerformance(\DateTime $datePerformance): static
    {
        $this->datePerformance = $datePerformance;

        return $this;
    }

    public function getJoueur(): ?Joueur
    {
        return $this->joueur;
    }

    public function setJoueur(?Joueur $joueur): static
    {
        $this->joueur = $joueur;

        return $this;
    }

    public function getRencontre(): ?Rencontre
    {
        return $this->rencontre;
    }

    public function setRencontre(?Rencontre $rencontre): static
    {
        $this->rencontre = $rencontre;

        return $this;
    }
}
