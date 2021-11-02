<?php

namespace App\DataFixtures\Quizz\Category;

use App\DataFixtures\Quizz\QuestionFixture;

class AutomatedTestsFixture extends QuestionFixture
{
    protected function getYamlPath(): string
    {
        return 'quizz/automated-tests.yml';
    }
}
