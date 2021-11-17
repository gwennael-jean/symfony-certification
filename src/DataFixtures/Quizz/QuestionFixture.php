<?php

namespace App\DataFixtures\Quizz;

use App\DataFixtures\AbstractFixture;
use App\Entity\Quizz\Answer;
use App\Entity\Quizz\Category;
use App\Entity\Quizz\Domain;
use App\Entity\Quizz\Question;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ObjectManager;

abstract class QuestionFixture extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $data = $this->getData();

        $category = (new Category())
            ->setName($data['category']);

        foreach ($data['questions'] as $questionKey => $questionData) {
            $question = (new Question())
                ->setCategory($category)
                ->setValue($questionData['question']);

            foreach ($questionData['answers'] as $answerData) {
                $answer = (new Answer())
                    ->setValue($answerData['value'])
                    ->setIsCorrect($answerData['correct']);

                $question->addAnswer($answer);
            }

            $question->setDomains($this->getDomains());

            $manager->persist($question);

            $this->addReference(sprintf('question.%s.%s', static::class, $questionKey), $question);
        }

        $manager->flush();
    }

    private function getDomains(): ArrayCollection
    {
        $domains = new ArrayCollection();
        foreach ($this->getDomainNames() as $name) {
            if (!$this->hasReference('domain.' . $name)) {
                $domain = (new Domain())
                    ->setName($name);

                $this->addReference('domain.' . $name, $domain);
            }

            $domains->add($this->getReference('domain.' . $name));
        }

        return $domains;
    }

    abstract protected function getDomainNames(): array;
}
