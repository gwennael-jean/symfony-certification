<?php

namespace App\DataFixtures\Quizz\Category;

use App\DataFixtures\Quizz\QuestionFixture;

class DependencyInjectionFixture extends QuestionFixture
{
    protected function getYamlPath(): string
    {
        return 'quizz/dependency-injection.yml';
    }
}
