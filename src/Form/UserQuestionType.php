<?php

namespace App\Form;

use App\Entity\Quizz\UserQuestion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserQuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('answers', UserAnswersType::class, [
            'view' => $options['view']
        ]);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        parent::buildView($view, $form, $options);

        /** @var UserQuestion $userQuestion */
        $userQuestion = $form->getData();

        $view->vars['question'] = $userQuestion->getQuestion();
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserQuestion::class,
            'view' => false,
        ]);
    }
}
