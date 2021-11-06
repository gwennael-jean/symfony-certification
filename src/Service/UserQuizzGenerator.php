<?php

namespace App\Service;

use App\Entity\Quizz\Domain;
use App\Entity\Quizz\Quizz;
use App\Entity\Quizz\UserQuizz;
use App\Service\UserQuizzGenerator\UserQuizzByDomainGenerator;

class UserQuizzGenerator implements UserQuizzGeneratorInterface
{
    public function __construct(
        private UserQuizzByDomainGenerator $userQuizzByDomainGenerator
    )
    {
    }

    public function generateByDomain(Domain $domain): UserQuizz
    {
        $this->userQuizzByDomainGenerator->setDomain($domain);

        return $this->userQuizzByDomainGenerator->generate();
    }

    public function generateByQuizz(Quizz $quizz): UserQuizz
    {
        // TODO: Implement generateByQuizz() method.
    }

}
