<?php

namespace App\Entity;

use App\Repository\ParticipantAnswerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParticipantAnswerRepository::class)]
class ParticipantAnswer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $user_answer = null;

    #[ORM\Column(length: 255)]
    private ?string $correct_answer = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $answer_date = null;

    #[ORM\ManyToOne(inversedBy: 'participantAnswers')]
    private ?Answer $answer = null;

    #[ORM\ManyToOne(inversedBy: 'participantAnswers')]
    private ?Participant $participation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserAnswer(): ?string
    {
        return $this->user_answer;
    }

    public function setUserAnswer(string $user_answer): static
    {
        $this->user_answer = $user_answer;

        return $this;
    }

    public function getCorrectAnswer(): ?string
    {
        return $this->correct_answer;
    }

    public function setCorrectAnswer(string $correct_answer): static
    {
        $this->correct_answer = $correct_answer;

        return $this;
    }

    public function getAnswerDate(): ?\DateTimeImmutable
    {
        return $this->answer_date;
    }

    public function setAnswerDate(\DateTimeImmutable $answer_date): static
    {
        $this->answer_date = $answer_date;

        return $this;
    }

    public function getAnswer(): ?Answer
    {
        return $this->answer;
    }

    public function setAnswer(?Answer $answer): static
    {
        $this->answer = $answer;

        return $this;
    }

    public function getParticipation(): ?Participant
    {
        return $this->participation;
    }

    public function setParticipation(?Participant $participation): static
    {
        $this->participation = $participation;

        return $this;
    }
}
