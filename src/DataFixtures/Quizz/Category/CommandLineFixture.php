<?php

namespace App\DataFixtures\Quizz\Category;

use App\DataFixtures\Quizz\QuestionFixture;

class CommandLineFixture extends QuestionFixture
{
    protected function getYamlPath(): string
    {
        return 'quizz/command-line.yml';
    }
}
