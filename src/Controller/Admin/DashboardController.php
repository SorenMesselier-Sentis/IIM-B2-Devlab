<?php

namespace App\Controller\Admin;

use App\Entity\News;
use App\Entity\User;
use App\Entity\Project;
use App\Entity\Technos;
use App\Entity\Comments;
use App\Controller\Admin\UserCrudController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\Component\Security\Core\User\UserInterface;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Amour De L\'Axe');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
            MenuItem::section('Contenu'),
            MenuItem::linkToCrud('News', 'fas fa-newspaper', News::class),
            MenuItem::linkToCrud('Technos', 'fas fa-book', Technos::class),

            MenuItem::section('Moderations'),
            MenuItem::linkToCrud('Commentaires', 'fas fa-comment', Comments::class),
            MenuItem::linkToCrud('Projets', 'fas fa-list', Project::class),
            // MenuItem::linkToCrud('Bug Report', 'fas fa-users', Bug::class),
            
            MenuItem::section('Gestion utilisateur'),
            MenuItem::linkToCrud('Users', 'fas fa-users', User::class),
            MenuItem::section('Other'),
            MenuItem::linkToLogout('Logout', 'fa fa-sign-out'),
            Menuitem::linkToRoute('Back To web site', 'fas fa-exchange', 'app_home'),
        ];
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)->setAvatarUrl('' . $user->getAvatar() );
    }
}

