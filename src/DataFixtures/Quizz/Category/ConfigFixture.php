<?php

namespace App\DataFixtures\Quizz\Category;

use App\DataFixtures\Quizz\QuestionFixture;

class ConfigFixture extends QuestionFixture
{
    protected function getYamlPath(): string
    {
        return 'quizz/config.yml';
    }
}
