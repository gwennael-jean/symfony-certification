<?php

namespace App\Entity\Quizz;

use App\Repository\Quizz\UserQuestionResultRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserQuestionResultRepository::class)
 */
class UserQuestionResult
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=UserQuestion::class, inversedBy="result", cascade={"persist", "remove"})
     */
    private $userQuestion;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isValid;

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

        $userQuestion->setResult($this);

        return $this;
    }

    public function isValid(): ?bool
    {
        return $this->isValid;
    }

    public function setIsValid(bool $isValid): self
    {
        $this->isValid = $isValid;

        return $this;
    }
}
