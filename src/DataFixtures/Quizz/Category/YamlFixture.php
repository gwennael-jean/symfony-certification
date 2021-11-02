<?php

namespace App\DataFixtures\Quizz\Category;

use App\DataFixtures\Quizz\QuestionFixture;

class YamlFixture extends QuestionFixture
{
    protected function getYamlPath(): string
    {
        return 'quizz/yaml.yml';
    }
}
