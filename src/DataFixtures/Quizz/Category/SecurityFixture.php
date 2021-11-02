<?php

namespace App\DataFixtures\Quizz\Category;

use App\DataFixtures\Quizz\QuestionFixture;

class SecurityFixture extends QuestionFixture
{
    protected function getYamlPath(): string
    {
        return 'quizz/security.yml';
    }
}
