<?php

namespace App\Entity\Quizz;

use App\Entity\User;
use App\Repository\Quizz\UserQuizzRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserQuizzRepository::class)
 */
class UserQuizz
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="quizzs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Quizz::class)
     */
    private $quizz;

    /**
     * @ORM\OneToMany(targetEntity=UserQuestion::class, mappedBy="userQuizz", orphanRemoval=true, cascade={"persist"})
     */
    private $userQuestions;

    public function __construct()
    {
        $this->userQuestions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

    public function setUser(?UserInterface $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getQuizz(): ?Quizz
    {
        return $this->quizz;
    }

    public function setQuizz(?Quizz $quizz): self
    {
        $this->quizz = $quizz;

        return $this;
    }

    /**
     * @return Collection|UserQuestion[]
     */
    public function getUserQuestions(): Collection
    {
        return $this->userQuestions;
    }

    public function addUserQuestion(UserQuestion $userQuestion): self
    {
        if (!$this->userQuestions->contains($userQuestion)) {
            $this->userQuestions[] = $userQuestion;
            $userQuestion->setUserQuizz($this);
        }

        return $this;
    }

    public function removeUserQuestion(UserQuestion $userQuestion): self
    {
        if ($this->userQuestions->removeElement($userQuestion)) {
            // set the owning side to null (unless already changed)
            if ($userQuestion->getUserQuizz() === $this) {
                $userQuestion->setUserQuizz(null);
            }
        }

        return $this;
    }
}
