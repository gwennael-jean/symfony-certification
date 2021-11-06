<?php

namespace App\Controller;

use App\Repository\Quizz\DomainRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    public function __construct(
        private DomainRepository $domainRepository,
    )
    {
    }

    #[Route('/dashboard', name: 'dashboard')]
    public function index(): Response
    {
        $domains = $this->domainRepository->findAll();

        return $this->render('dashboard/index.html.twig', [
            'domains' => $domains,
        ]);
    }
}
