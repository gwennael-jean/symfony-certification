<?php

namespace App\Form;

use App\Entity\Quizz\UserAnswer;
use App\Entity\Quizz\UserQuestion;
use App\Repository\Quizz\AnswerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserAnswersType extends AbstractType implements DataTransformerInterface
{
    public function __construct(
        private AnswerRepository $answerRepository
    )
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addViewTransformer($this);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        parent::buildView($view, $form, $options);

        /** @var UserQuestion $userQuestion */
        $userQuestion = $form->getParent()->getData();

        $view->vars['answers'] = $userQuestion->getQuestion()->getAnswers();
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'compound' => false,
            'multiple' => true,
        ]);
    }

    public function transform($value)
    {
        $data = [];

        if ($value instanceof Collection) {
            $data = $value->map(fn (UserAnswer $userAnswer) => $userAnswer->getValue()->getId())->toArray();
        }

        return $data;
    }

    public function reverseTransform($value)
    {
        $answers = new ArrayCollection();

        if (is_iterable($value)) {
            foreach ($value as $answer_id) {
                $answer = $this->answerRepository->find($answer_id);

                $userAnswer = (new UserAnswer())
                    ->setValue($answer);

                $answers->add($userAnswer);
            }
        }

        return $answers;
    }
}
