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

class UserQuizzController extends AbstractController
{
    public function __construct(
        private UserQuizzGeneratorInterface $userQuizzGenerator,
    )
    {
    }

    #[Route('/user-quizz/{id}', name: 'userquizz_index', requirements: ['id' => '\d+'])]
    public function index(Request $request, UserQuizz $userQuizz): Response
    {
        $form = $this->createForm(UserQuizzType::class, $userQuizz);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->persist($userQuizz);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('userquizz_result_compute', [
                'id' => $userQuizz->getId(),
            ]);
        }

        return $this->render('userquizz/index.html.twig', [
            'userQuizz' => $userQuizz,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/user-quizz/domain/{id}/generate', name: 'userquizz_generate_by_domain', requirements: ['id' => '\d+'])]
    public function generateByDomain(Domain $domain): Response
    {
        $userQuizz = ($this->userQuizzGenerator->generateByDomain($domain))
            ->setUser($this->getUser());

        $this->getDoctrine()->getManager()->persist($userQuizz);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('userquizz_index', [
            'id' => $userQuizz->getId()
        ]);
    }

    #[Route('/user-quizz/{id}/update', name: 'userquizz_update', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function update(Request $request, UserQuizz $userQuizz): Response
    {
        $form = $this->createForm(UserQuizzType::class, $userQuizz);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($userQuizz);
            $this->getDoctrine()->getManager()->flush();

            return $this->json([
                'success' => true
            ]);
        }

        return $this->json([
            'success' => false
        ]);
    }
}
