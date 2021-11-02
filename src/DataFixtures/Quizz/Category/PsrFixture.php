<?php

namespace App\DataFixtures\Quizz\Category;

use App\DataFixtures\Quizz\QuestionFixture;

class PsrFixture extends QuestionFixture
{
    protected function getYamlPath(): string
    {
        return 'quizz/psr.yml';
    }
}
