<?php

namespace App\Entity\Quizz;

use App\Repository\Quizz\UserAnswerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserAnswerRepository::class)
 */
class UserAnswer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=UserQuestion::class, inversedBy="answers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userQuestion;

    /**
     * @ORM\ManyToOne(targetEntity=Answer::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $value;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserQuestion(): ?UserQuestion
    {
        return $this->userQuestion;
    }

    public function setUserQuestion(?UserQuestion $userQuestion): self
    {
        $this->userQuestion = $userQuestion;

        return $this;
    }

    public function getValue(): ?Answer
    {
        return $this->value;
    }

    public function setValue(?Answer $value): self
    {
        $this->value = $value;

        return $this;
    }
}
