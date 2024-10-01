<?php

namespace App\Entity;

use App\Repository\AnswerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnswerRepository::class)]
class Answer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $text = null;

    #[ORM\Column]
    private ?bool $correct = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\ManyToOne(inversedBy: 'answers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Question $question = null;

    /**
     * @var Collection<int, ParticipantAnswer>
     */
    #[ORM\OneToMany(targetEntity: ParticipantAnswer::class, mappedBy: 'answer')]
    private Collection $participantAnswers;

    public function __construct()
    {
        $this->participantAnswers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): static
    {
        $this->text = $text;

        return $this;
    }

    public function isCorrect(): ?bool
    {
        return $this->correct;
    }

    public function setCorrect(bool $correct): static
    {
        $this->correct = $correct;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): static
    {
        $this->active = $active;

        return $this;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): static
    {
        $this->question = $question;

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
            $participantAnswer->setAnswer($this);
        }

        return $this;
    }

    public function removeParticipantAnswer(ParticipantAnswer $participantAnswer): static
    {
        if ($this->participantAnswers->removeElement($participantAnswer)) {
            // set the owning side to null (unless already changed)
            if ($participantAnswer->getAnswer() === $this) {
                $participantAnswer->setAnswer(null);
            }
        }

        return $this;
    }
}
