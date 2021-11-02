<?php

namespace App\DataFixtures\Quizz\Category;

use App\DataFixtures\Quizz\QuestionFixture;

class ArchitectureFixture extends QuestionFixture
{
    protected function getYamlPath(): string
    {
        return 'quizz/architecture.yml';
    }
}
