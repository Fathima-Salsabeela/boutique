<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Produit;
use App\Entity\Commande;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')] 
    public function index(): Response
    {
         return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Boutique');
    }

    public function configureMenuItems(): iterable
    {
      return[
           MenuItem::linkToRoute("Retour à l'accueil", 'fas fa-arrow-left', 'home'),
           MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
           MenuItem::section('Gestion des données'),
           MenuItem::linkToCrud('Commandes', 'fas fa-cash-register', Commande::class),
           MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class),
         MenuItem::linkToCrud('Produits', 'fas fa-tshirt', Produit::class),
        ];   
    }
}
