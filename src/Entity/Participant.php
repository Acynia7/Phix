<?php

namespace App\Entity;

use App\Repository\ParticipantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @var Collection<int, ParticipantAnswer>
     */
    #[ORM\OneToMany(targetEntity: ParticipantAnswer::class, mappedBy: 'participation')]
    private Collection $participantAnswers;

    /**
     * @var Collection<int, Session>
     */
    #[ORM\ManyToMany(targetEntity: Session::class, inversedBy: 'participants')]
    private Collection $session;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function __construct()
    {
        $this->participantAnswers = new ArrayCollection();
        $this->session = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, ParticipantAnswer>
     */
    public function getParticipantAnswers(): Collection
    {
        return $this->participantAnswers;
    }

    public function addParticipantAnswer(ParticipantAnswer $participantAnswer): static
    {
        if (!$this->participantAnswers->contains($participantAnswer)) {
            $this->participantAnswers->add($participantAnswer);
            $participantAnswer->setParticipation($this);
        }

        return $this;
    }

    public function removeParticipantAnswer(ParticipantAnswer $participantAnswer): static
    {
        if ($this->participantAnswers->removeElement($participantAnswer)) {
            // set the owning side to null (unless already changed)
            if ($participantAnswer->getParticipation() === $this) {
                $participantAnswer->setParticipation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Session>
     */
    public function getSession(): Collection
    {
        return $this->session;
    }

    public function addSession(Session $session): static
    {
        if (!$this->session->contains($session)) {
            $this->session->add($session);
        }

        return $this;
    }

    public function removeSession(Session $session): static
    {
        $this->session->removeElement($session);

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
