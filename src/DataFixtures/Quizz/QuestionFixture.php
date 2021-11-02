<?php

namespace App\DataFixtures\Quizz;

use App\DataFixtures\AbstractFixture;
use App\Entity\Quizz\Answer;
use App\Entity\Quizz\Category;
use App\Entity\Quizz\Question;
use Doctrine\Persistence\ObjectManager;

abstract class QuestionFixture extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $data = $this->getData();

        $category = (new Category())
            ->setName($data['category']);

        foreach ($data['questions'] as $questionData) {
            $question = (new Question())
                ->setCategory($category)
                ->setValue($questionData['question']);

            foreach ($questionData['answers'] as $answerData) {
                $answer = (new Answer())
                    ->setValue($answerData['value'])
                    ->setIsCorrect($answerData['correct']);

                $question->addAnswer($answer);
            }

            $manager->persist($question);
        }

        $manager->flush();
    }
}
