<?php

namespace App\Service\UserQuizzResult\Type;

use App\Entity\Quizz\UserQuizz;
use App\Service\UserQuizzResult\UserQuizzResultTypeInterface;

class DefaultUserQuizzResultType implements UserQuizzResultTypeInterface
{
    public function getName(): string
    {
        return 'default';
    }

    public function compute(UserQuizz $userQuizz): void
    {
        dd($userQuizz);
    }

}
