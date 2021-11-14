<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Quizz\QuestionCrudController;
use App\Controller\Admin\Quizz\UserQuizzCrudController;
use App\Entity\Quizz\Category;
use App\Entity\Quizz\Question;
use App\Entity\Quizz\UserQuizz;
use App\Entity\User;
use App\Repository\Quizz\QuestionRepository;
use App\Repository\Quizz\UserQuizzRepository;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private UserRepository $userRepository,
        private UserQuizzRepository $userQuizzRepository,
        private QuestionRepository $questionRepository,
    )
    {
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig', [
            'count' => [
                'user' => [
                    'value' => $this->userRepository->countAll(),
                    'link' => $this->generateUrl('admin', [
                        'crudControllerFqcn' => UserCrudController::class,
                        'crudAction' => 'index',
                        'menuIndex' => 2,
                    ]),
                ],
                'question' => [
                    'value' => $this->questionRepository->countAll(),
                    'link' => $this->generateUrl('admin', [
                        'crudControllerFqcn' => QuestionCrudController::class,
                        'crudAction' => 'index',
                        'menuIndex' => 5,
                    ]),
                ],
                'userquizz' => [
                    'value' => $this->userQuizzRepository->countAll(),
                    'link' => $this->generateUrl('admin', [
                        'crudControllerFqcn' => UserQuizzCrudController::class,
                        'crudAction' => 'index',
                        'menuIndex' => 6,
                    ]),
                ],
            ]
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Www')
            ->disableUrlSignatures();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');

         yield MenuItem::section('Users');
         yield MenuItem::linkToCrud('User List', 'fas fa-users', User::class);

         yield MenuItem::section('Quizz');
         yield MenuItem::linkToCrud('Category List', 'fas fa-certificate', Category::class);
         yield MenuItem::linkToCrud('Question List', 'fas fa-question-circle', Question::class);
         yield MenuItem::linkToCrud('User Quizz List', 'fas fa-question-circle', UserQuizz::class);
    }
}
