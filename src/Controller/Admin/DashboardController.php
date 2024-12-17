<?php

namespace App\Controller\Admin;

use App\Entity\Quiz;
use App\Entity\QuizState;
use App\Entity\User;
use App\Entity\SessionState;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(QuizCrudController::class)->generateUrl();

        return $this->redirect($url);

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('App');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Back to the website', 'fas fa-home', 'homepage');
        yield MenuItem::linkToCrud('Quiz', 'fas fa-map-marker-alt', Quiz::class);
        yield MenuItem::linkToCrud('QuizState', 'fas fa-comments', QuizState::class);
        yield MenuItem::linkToCrud('SessionState', 'fas fa-comments', SessionState::class);
        yield MenuItem::linkToCrud('Users', 'fas fa-comments', User::class);
    }
}
