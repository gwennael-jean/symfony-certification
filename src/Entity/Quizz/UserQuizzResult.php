<?php

namespace App\Entity\Quizz;

use App\Repository\Quizz\UserQuizzResultRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserQuizzResultRepository::class)
 */
class UserQuizzResult
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", name="success")
     */
    private $isSuccess;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isSuccess(): ?bool
    {
        return $this->isSuccess;
    }

    public function setSuccess(bool $isSuccess): self
    {
        $this->isSuccess = $isSuccess;

        return $this;
    }
}
