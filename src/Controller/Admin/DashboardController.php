<?php

namespace App\Controller\Admin;

use App\Entity\Quizz\Category;
use App\Entity\Quizz\Question;
use App\Entity\Quizz\UserQuizz;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Www');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');

         yield MenuItem::section('Users');
         yield MenuItem::linkToCrud('User List', 'fas fa-users', User::class);

         yield MenuItem::section('Quizz');
         yield MenuItem::linkToCrud('Category List', 'fas fa-certificate', Category::class);
         yield MenuItem::linkToCrud('Question List', 'fas fa-question-circle', Question::class);
    }
}
