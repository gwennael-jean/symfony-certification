<?php

namespace App\Service\UserQuizzGenerator;

use App\Entity\Quizz\Domain;
use App\Entity\Quizz\UserQuestion;
use App\Entity\Quizz\UserQuizz;
use App\Repository\Quizz\QuestionRepository;

class UserQuizzByDomainGenerator implements UserQuizzTypeGeneratorInterface
{
    private Domain $domain;

    public function __construct(
        private QuestionRepository $questionRepository
    )
    {
    }

    public function generate(): UserQuizz
    {
        $userQuizz = new UserQuizz();

        $questions = $this->questionRepository->findRandomByDomain($this->getDomain());

        foreach ($questions as $question) {
            $userQuestion = (new UserQuestion())
                ->setQuestion($question);

            $userQuizz->addUserQuestion($userQuestion);
        }

        return $userQuizz;
    }

    public function getDomain(): Domain
    {
        return $this->domain;
    }

    public function setDomain(Domain $domain)
    {
        $this->domain = $domain;
    }
}
