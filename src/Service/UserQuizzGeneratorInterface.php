<?php

namespace App\Service;

use App\Entity\Quizz\Domain;
use App\Entity\Quizz\Quizz;
use App\Entity\Quizz\UserQuizz;

interface UserQuizzGeneratorInterface
{
    public function generateByDomain(Domain $domain): UserQuizz;

    public function generateByQuizz(Quizz $quizz): UserQuizz;
}
