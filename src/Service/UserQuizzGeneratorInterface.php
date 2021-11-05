<?php

namespace App\Service;

use App\Entity\Quizz\Domain;
use App\Entity\Quizz\Quizz;

interface UserQuizzGeneratorInterface
{
    public function generate(Domain $domain);

    public function generateByQuizz(Quizz $quizz);
}
