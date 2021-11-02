<?php

namespace App\DataFixtures\Quizz\Category;

use App\DataFixtures\Quizz\QuestionFixture;

class MiscFixture extends QuestionFixture
{
    protected function getYamlPath(): string
    {
        return 'quizz/misc.yml';
    }
}
