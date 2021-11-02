<?php

namespace App\DataFixtures\Quizz\Category;

use App\DataFixtures\Quizz\QuestionFixture;

class StandardizationFixture extends QuestionFixture
{
    protected function getYamlPath(): string
    {
        return 'quizz/standardization.yml';
    }
}
