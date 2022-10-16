<?php

namespace App\Controller\Admin;


use App\Entity\Annonce;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(UserCrudController::class)->generateUrl();

        return $this->redirect($url);

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Job Board');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Page d\'accueil', 'fas fa-home', 'app_home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user-check', User::class);
        yield MenuItem::linkToCrud('Annonces', 'fa-solid fa-truck-plane', Annonce::class);
    }
}


//->setPermission('ROLE_ADMIN')