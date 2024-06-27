<?php
namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Contact;
use App\Entity\Entreprise;
use App\Entity\Candidature;
use App\Entity\OffreEmploi;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin.index')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }


    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('SimpleJob - Administration')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Retour au menu', 'fas fa-home', 'home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Entreprise', 'fas fa-fax', Entreprise::class);
        yield MenuItem::linkToCrud('Candidature', 'fas fa-copy', Candidature::class);
        yield MenuItem::linkToCrud('OffreEmploi', 'fas fa-regular fa-briefcase', OffreEmploi::class);
        yield MenuItem::linkToCrud('Contact', 'fas fa-regular fa-briefcase', Contact::class);
    }
}