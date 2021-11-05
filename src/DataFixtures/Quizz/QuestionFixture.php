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
    private ArrayCollection $domains;

    public function __construct()
    {
        parent::__construct();
        $this->domains = new ArrayCollection();
    }

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

            $question->setDomains($this->getDomains());

            $manager->persist($question);
        }

        $manager->flush();
    }

    private function getDomains(): ArrayCollection
    {
        $domains = new ArrayCollection();
        foreach ($this->getDomainNames() as $name) {
            if (!$this->domains->containsKey($name)) {
                $domain = (new Domain())
                    ->setName($name);

                $this->domains->set($name, $domain);
            }

            $domains->add($this->domains->get($this->getDomainName()));
        }

        return $domains;
    }

    abstract protected function getDomainNames(): array;
}
