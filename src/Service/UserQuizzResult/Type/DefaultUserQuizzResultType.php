<?php

namespace App\Service\UserQuizzResult\Type;

use App\Entity\Quizz\Answer;
use App\Entity\Quizz\UserAnswer;
use App\Entity\Quizz\UserQuestion;
use App\Entity\Quizz\UserQuestionResult;
use App\Entity\Quizz\UserQuizz;
use App\Entity\Quizz\UserQuizzResult;
use App\Service\UserQuizzResult\UserQuizzResultTypeInterface;
use Doctrine\Common\Collections\ArrayCollection;

class DefaultUserQuizzResultType implements UserQuizzResultTypeInterface
{
    public function getName(): string
    {
        return 'default';
    }

    public function compute(UserQuizz $userQuizz): void
    {
        $result = new UserQuizzResult();

        $this->checkQuestions($userQuizz);

        $validAnswers = $userQuizz->getUserQuestions()
            ->map(fn (UserQuestion $userQuestion) => $userQuestion->getResult())
            ->filter(fn (UserQuestionResult $userQuestionResult) => $userQuestionResult->isValid());

        $percent = ($validAnswers->count() / $userQuizz->getUserQuestions()->count()) * 100;

        $result->setSuccess($percent >= 50);

        $userQuizz->setResult($result);
    }

    private function checkQuestions(UserQuizz $userQuizz)
    {
        foreach ($userQuizz->getUserQuestions() as $userQuestion) {
            $userQuestion->setResult(new UserQuestionResult());
            $this->checkQuestion($userQuestion);
        }
    }

    private function checkQuestion(UserQuestion $userQuestion)
    {
        $correctAnswer = $userQuestion->getQuestion()->getAnswers()
            ->filter(fn (Answer $answer) => $answer->isCorrect());

        $checkedAnswers = $userQuestion->getAnswers()->map(fn (UserAnswer $answer) => $answer->getValue());

        $diffAnswers = new ArrayCollection(array_udiff($correctAnswer->toArray(), $checkedAnswers->toArray(), function (Answer $a, Answer $b) {
            if ($a->getValue() > $b->getValue()) {
                return 1;
            } elseif ($a->getValue() < $b->getValue()) {
                return -1;
            }

            return 0;
        }));

        $userQuestion->getResult()->setIsValid($diffAnswers->isEmpty());
    }
}
