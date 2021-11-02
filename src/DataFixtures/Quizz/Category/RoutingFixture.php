<?php

namespace App\DataFixtures\Quizz\Category;

use App\DataFixtures\Quizz\QuestionFixture;

class RoutingFixture extends QuestionFixture
{
    protected function getYamlPath(): string
    {
        return 'quizz/routing.yml';
    }
}
