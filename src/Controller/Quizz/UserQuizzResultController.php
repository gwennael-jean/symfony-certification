<?php

namespace App\Controller\Quizz;

use App\Entity\Quizz\Domain;
use App\Entity\Quizz\UserQuizz;
use App\Form\UserQuizzType;
use App\Service\UserQuizzGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserQuizzResultController extends AbstractController
{
    #[Route('/user-quizz/{id}/resultat', name: 'userquizz_result_show', requirements: ['id' => '\d+'])]
    public function show(Request $request, UserQuizz $userQuizz): Response
    {
        // TODO: Visualiser le résultat du quizz
    }

    #[Route('/user-quizz/{id}/finalisation', name: 'userquizz_result_compute', requirements: ['id' => '\d+'])]
    public function compute(Request $request, UserQuizz $userQuizz): Response
    {
        // TODO: Calculer le score du quizz
    }
}
