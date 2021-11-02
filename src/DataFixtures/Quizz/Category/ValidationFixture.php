<?php

namespace App\DataFixtures\Quizz\Category;

use App\DataFixtures\Quizz\QuestionFixture;

class ValidationFixture extends QuestionFixture
{
    protected function getYamlPath(): string
    {
        return 'quizz/validation.yml';
    }
}
