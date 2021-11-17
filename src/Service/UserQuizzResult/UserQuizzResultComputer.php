<?php

namespace App\Service\UserQuizzResult;

use App\Entity\Quizz\UserQuizz;
use Doctrine\Common\Collections\ArrayCollection;

class UserQuizzResultComputer implements UserQuizzResultComputerInterface
{
    private ArrayCollection $userQuizzResults;

    public function __construct()
    {
        $this->userQuizzResults = new ArrayCollection();
    }

    public function addUserQuizzResult( UserQuizzResultTypeInterface $userQuizzResultType): void
    {
        $this->userQuizzResults->set($userQuizzResultType->getName(), $userQuizzResultType);
    }

    public function getUserQuizzResult(string $name): UserQuizzResultTypeInterface
    {
        return $this->userQuizzResults->get($name);
    }

    public function compute(UserQuizz $userQuizz): void
    {
        $this->getUserQuizzResult('default')->compute($userQuizz);
    }
}
