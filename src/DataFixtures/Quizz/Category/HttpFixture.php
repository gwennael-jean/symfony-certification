<?php

namespace App\DataFixtures\Quizz\Category;

use App\DataFixtures\Quizz\QuestionFixture;

class HttpFixture extends QuestionFixture
{
    protected function getYamlPath(): string
    {
        return 'quizz/http.yml';
    }
}
