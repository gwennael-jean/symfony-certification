<?php

namespace App\DataFixtures\Quizz\Category;

use App\DataFixtures\Quizz\QuestionFixture;

class ProcessFixture extends QuestionFixture
{
    protected function getYamlPath(): string
    {
        return 'quizz/process.yml';
    }
}
