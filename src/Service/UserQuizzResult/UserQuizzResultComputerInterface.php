<?php

namespace App\Service\UserQuizzResult;

use App\Entity\Quizz\UserQuizz;

interface UserQuizzResultComputerInterface
{
    public function compute(UserQuizz $userQuizz): void;
}
