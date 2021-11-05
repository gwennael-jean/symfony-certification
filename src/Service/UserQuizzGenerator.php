<?php

namespace App\Service;

use App\Entity\Quizz\Domain;
use App\Entity\Quizz\Quizz;
use App\Repository\Quizz\QuestionRepository;

class UserQuizzGenerator implements UserQuizzGeneratorInterface
{
    public function __construct(
        private QuestionRepository $questionRepository
    )
    {
    }

    public function generate(Domain $domain)
    {
        // TODO: Implement generate() method.
    }

    public function generateByQuizz(Quizz $quizz)
    {
        // TODO: Implement generateByQuizz() method.
    }

}
