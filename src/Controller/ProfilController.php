<?php

namespace App\Controller;

use App\Repository\CommandeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'profil')]
    public function index(CommandeRepository $repo): Response
    {
        $coms = $repo->findBy(['user' => $this->getUser()]);

        return $this->render('profil/index.html.twig', [
            'coms' => $coms
        ]);
    }

    
}
