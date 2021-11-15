<?php

namespace App\Controller\Quizz;

use App\Entity\Quizz\UserQuizz;
use App\Form\UserQuizzType;
use App\Repository\Quizz\DomainRepository;
use App\Repository\Quizz\UserQuizzRepository;
use App\Service\UserQuizzGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserQuizzController extends AbstractController
{
    public function __construct(
        private UserQuizzGeneratorInterface $userQuizzGenerator,
        private DomainRepository            $domainRepository,
        private UserQuizzRepository         $userQuizzRepository,
    )
    {
    }

    #[Route('/user-quizz/{id}', name: 'userquizz_index')]
    public function index(Request $request, int $id): Response
    {
        $userQuizz = $this->userQuizzRepository->find($id);

        $form = $this->createForm(UserQuizzType::class, $userQuizz);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->persist($userQuizz);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('userquizz/index.html.twig', [
            'userQuizz' => $userQuizz,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/user-quizz/domain/{id}/generate', name: 'userquizz_generate_by_domain')]
    public function generateByDomain(int $id): Response
    {
        $domain = $this->domainRepository->find($id);

        $userQuizz = ($this->userQuizzGenerator->generateByDomain($domain))
            ->setUser($this->getUser());

        $this->getDoctrine()->getManager()->persist($userQuizz);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('userquizz_index', [
            'id' => $userQuizz->getId()
        ]);
    }

    #[Route('/user-quizz/{id}/update', name: 'userquizz_update', methods: ['POST'])]
    public function update(Request $request, int $id): Response
    {
        $userQuizz = $this->userQuizzRepository->find($id);

        $this->getDoctrine()->getManager()->persist($userQuizz);
        $this->getDoctrine()->getManager()->flush();

        return $this->json([
            'success' => true
        ]);
    }
}
