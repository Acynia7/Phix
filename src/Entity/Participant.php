<?php

namespace App\Entity;

use App\Repository\ParticipantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParticipantRepository::class)]
class Participant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $score = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $participation_date = null;

    #[ORM\Column(nullable: true)]
    private ?int $attempts = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): static
    {
        $this->score = $score;

        return $this;
    }

    public function getParticipationDate(): ?\DateTimeImmutable
    {
        return $this->participation_date;
    }

    public function setParticipationDate(\DateTimeImmutable $participation_date): static
    {
        $this->participation_date = $participation_date;

        return $this;
    }

    public function getAttempts(): ?int
    {
        return $this->attempts;
    }

    public function setAttempts(?int $attempts): static
    {
        $this->attempts = $attempts;

        return $this;
    }
}
