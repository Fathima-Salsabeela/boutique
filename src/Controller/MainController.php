<?php

namespace App\Controller;

use cs;
use App\Entity\Produit;
use App\Entity\Commande;
use App\Form\CommandeType;
use App\Service\CartService;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{   #[Route('/')]
    public function root()
    {
       return $this->redirectToRoute('home');
    }

    #[Route('/main', name: 'home')]
    public function index(ProduitRepository $repo): Response
    {  
         $criteria = new Criteria;
        $criteria->where(Criteria::expr()->gt('stock', 0));
        $produits = $repo->matching($criteria);

        return $this->render('main/index.html.twig', [
            'produits' => $produits
        ]);
    }
    
    #[Route('/checkout', name: 'checkout')]
    public function checkout(CartService $cs, EntityManagerInterface $manager, ProduitRepository $repo)
    {

        $cartWithData = $cs->getCartWithData();

        foreach ($cartWithData as $item) {
            $commande = new Commande;
            $commande->setDateEnregistrement(new \DateTime)
                ->setEtat("en cours de traitement")
                ->setUser($this->getUser())
                ->setMontant($item['product']->getPrix() * $item['quantity'])
                ->setProduit($item['product'])
                ->setQuantite($item['quantity']);

            $produit = $repo->find($item['product']->getId());
            $produit->setStock($produit->getStock() - $commande->getQuantite());
            $manager->persist($commande);
        }
        $manager->flush();
        
        $cs->empty();
        return $this->render('main/checkout_success.html.twig');
    }

    #[Route('/main', name: 'femme')]
    public function femme (ProduitRepository $repo): Response
    {  
         $criteria = new Criteria;
        $criteria->where(Criteria::expr()->gt('stock', 0));
        $produits = $repo->matching($criteria);

        return $this->render('main/femme.html.twig', [
            'produits' => $produits
        ]);
    }
   
}
