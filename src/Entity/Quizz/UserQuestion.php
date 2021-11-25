<?php

namespace App\Entity\Quizz;

use App\Repository\Quizz\UserQuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserQuestionRepository::class)
 */
class UserQuestion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=UserQuizz::class, inversedBy="userQuestions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userQuizz;

    /**
     * @ORM\ManyToOne(targetEntity=Question::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $question;

    /**
     * @ORM\OneToMany(targetEntity=UserAnswer::class, mappedBy="userQuestion", orphanRemoval=true, cascade={"persist", "remove"})
     */
    private $answers;

    /**
     * @ORM\OneToOne(targetEntity=UserQuestionResult::class, mappedBy="userQuestion", cascade={"persist", "remove"})
     */
    private $result;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserQuizz(): ?UserQuizz
    {
        return $this->userQuizz;
    }

    public function setUserQuizz(?UserQuizz $userQuizz): self
    {
        $this->userQuizz = $userQuizz;

        return $this;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

        return $this;
    }

    /**
     * @return Collection|UserAnswer[]
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(UserAnswer $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers[] = $answer;
            $answer->setUserQuestion($this);
        }

        return $this;
    }

    public function removeAnswer(UserAnswer $answer): self
    {
        if ($this->answers->removeElement($answer)) {
            // set the owning side to null (unless already changed)
            if ($answer->getUserQuestion() === $this) {
                $answer->setUserQuestion(null);
            }
        }

        return $this;
    }

    public function getResult(): ?UserQuestionResult
    {
        return $this->result;
    }

    public function setResult(?UserQuestionResult $result): self
    {
        // unset the owning side of the relation if necessary
        if ($result === null && $this->result !== null) {
            $this->result->setUserQuestion(null);
        }

        // set the owning side of the relation if necessary
        if ($result !== null && $result->getUserQuestion() !== $this) {
            $result->setUserQuestion($this);
        }

        $this->result = $result;

        return $this;
    }
}
