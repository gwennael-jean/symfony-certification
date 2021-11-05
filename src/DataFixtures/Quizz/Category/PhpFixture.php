<?php

namespace App\DataFixtures\Quizz\Category;

use App\DataFixtures\Quizz\QuestionFixture;

class PhpFixture extends QuestionFixture
{
    protected function getDomainNames(): array
    {
        return [
            'PHP',
            'Symfony'
        ];
    }

    protected function getYamlPath(): string
    {
        return 'quizz/php.yml';
    }
}
