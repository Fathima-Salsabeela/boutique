<?php

namespace App\Controller\Admin;

use App\Entity\Avis;
use App\Entity\Bebe;
use App\Entity\User;
use App\Entity\Femme;
use App\Entity\Homme;
use App\Entity\Contact;
use App\Entity\Enfants;
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
            ->setTitle(' ANEEQA BOUTIQUE');
    }

    public function configureMenuItems(): iterable
    {
      return[
           MenuItem::linkToRoute("Retour à l'accueil", 'fas fa-arrow-left', 'home'),
           MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
           
           MenuItem::section('Produit'),
           MenuItem::linkToCrud('femme', 'fas fa-tshirt', Femme::class),
           MenuItem::linkToCrud('homme', 'fas fa-tshirt', Homme::class),
           MenuItem::linkToCrud('enfants', 'fas fa-tshirt', Enfants::class),
           MenuItem::linkToCrud('bebe', 'fas fa-tshirt', Bebe::class),
           MenuItem::linkToCrud('maison', 'fas fa-tshirt', Produit::class),
           MenuItem::section('Gestion des Commandes'),
           MenuItem::linkToCrud('Commandes', 'fas fa-cash-register', Commande::class),
           MenuItem::section('Utilisateurs'),
           MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class),
           MenuItem::section('Contact'),
           MenuItem::linkToCrud('Contact', 'fas fa-tshirt', Contact::class),
           MenuItem::linkToCrud('Avis', 'fas fa-tshirt', Avis::class),
         
           
        ];   
    }
}
