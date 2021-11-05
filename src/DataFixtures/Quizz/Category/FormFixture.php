<?php

namespace App\DataFixtures\Quizz\Category;

use App\DataFixtures\Quizz\QuestionFixture;

class FormFixture extends QuestionFixture
{
    protected function getDomainNames(): array
    {
        return [
            'Symfony'
        ];
    }

    protected function getYamlPath(): string
    {
        return 'quizz/forms.yml';
    }
}
