<?php

namespace App\Controller\Admin\Quizz;

use App\Entity\Quizz\UserQuizz;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
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
            AssociationField::new('user')
                ->formatValue(fn ($value, UserQuizz $entity) => $entity->getUser()->getEmail()),
            AssociationField::new('quizz')
                ->formatValue(fn ($value, UserQuizz $entity) => null !== $entity->getQuizz() ? $entity->getQuizz()->getName() : null),
        ];
    }
}
