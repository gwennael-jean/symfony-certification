<?php

namespace App\Controller\Quizz;

use App\Entity\Quizz\Domain;
use App\Entity\Quizz\UserQuizz;
use App\Form\UserQuizzType;
use App\Service\UserQuizzGeneratorInterface;
use App\Service\UserQuizzResult\UserQuizzResultComputerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserQuizzResultController extends AbstractController
{
    #[Route('/user-quizz/{id}/resultat', name: 'userquizz_result_show', requirements: ['id' => '\d+'])]
    public function show(UserQuizz $userQuizz): Response
    {
        $form = $this->createForm(UserQuizzType::class, $userQuizz, [
            'view' => true
        ]);

        return $this->render('userquizz/result.html.twig', [
            'userQuizz' => $userQuizz,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/user-quizz/{id}/finalisation', name: 'userquizz_result_compute', requirements: ['id' => '\d+'])]
    public function compute(UserQuizz $userQuizz, UserQuizzResultComputerInterface $userQuizzResultComputer): Response
    {
        $userQuizzResultComputer->compute($userQuizz);

        $this->getDoctrine()->getManager()->persist($userQuizz);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('userquizz_result_show', [
            'id' => $userQuizz->getId()
        ]);
    }
}
