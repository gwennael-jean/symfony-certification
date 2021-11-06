<?php

namespace App\Service\UserQuizzGenerator;

use App\Entity\Quizz\UserQuizz;

interface UserQuizzTypeGeneratorInterface
{
    public function generate(): UserQuizz;
}
