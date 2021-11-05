<?php

namespace App\Service;

use App\Entity\Quizz\Quizz;

interface UserQuizzGeneratorInterface
{
    public function generate();

    public function generateByQuizz(Quizz $quizz);
}
