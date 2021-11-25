<?php

namespace App\Service\UserQuizzResult;

use App\Entity\Quizz\UserQuizz;

interface UserQuizzResultTypeInterface
{
    public function getName(): string;

    public function compute(UserQuizz $userQuizz): void;
}
