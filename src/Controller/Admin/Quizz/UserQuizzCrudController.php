<?php

namespace App\Controller\Admin\Quizz;

use App\Entity\Quizz\UserQuizz;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class UserQuizzCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UserQuizz::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
        ];
    }
}
