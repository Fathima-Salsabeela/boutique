<?php

namespace App\Controller;

use cs;
use App\Entity\Avis;
use App\Entity\Contact;
use App\Entity\Produit;
use App\Entity\Commande;
use App\Form\AvisFormType;
use App\Form\CommandeType;
use App\Service\CartService;
use App\Form\ContactFormType;
use App\Repository\AvisRepository;
use App\Repository\BebeRepository;
use App\Repository\FemmeRepository;
use App\Repository\HommeRepository;
use App\Repository\ContactRepository;
use App\Repository\EnfantsRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/maison', name: 'maison')]
    public function maison(ProduitRepository $repo): Response
    {  
         $criteria = new Criteria;
        $criteria->where(Criteria::expr()->gt('stock', 0));
        $produits = $repo->matching($criteria);

        return $this->render('main/maison.html.twig', [
            'produits' => $produits
        ]);
    }
    #[Route('/bebe', name: 'bebe')]
    public function bebe(BebeRepository $repo): Response
    {  
         $criteria = new Criteria;
        $criteria->where(Criteria::expr()->gt('stock', 0));
        $bebe = $repo->matching($criteria);

        return $this->render('main/bebe.html.twig', [
            'bebe' => $bebe
        ]);
    }
    #[Route('/enfants', name: 'enfants')]
    public function enfants(EnfantsRepository $repo): Response
    {  
         $criteria = new Criteria;
        $criteria->where(Criteria::expr()->gt('stock', 0));
        $enfants= $repo->matching($criteria);

        return $this->render('main/enfants.html.twig', [
             'enfants' => $enfants
        ]);
    }
    #[Route('/homme', name: 'homme')]
    public function homme(HommeRepository $repo): Response
    {  
         $criteria = new Criteria;
        $criteria->where(Criteria::expr()->gt('stock', 0));
        $homme = $repo->matching($criteria);

        return $this->render('main/homme.html.twig', [
             'homme' => $homme
        ]);
    }

    #[Route('/femme', name: 'femme')]
    public function femme (FemmeRepository $repo): Response
    {  
         $criteria = new Criteria;
        $criteria->where(Criteria::expr()->gt('stock', 0));
        $femme = $repo->matching($criteria);

        return $this->render('main/femme.html.twig', [
            'femme' => $femme
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

   
    #[Route("/contact", name:"contact")]
    public function formContact(ContactRepository $repo , EntityManagerInterface $manager, Request $request, Contact $contact = null)
  {  $contacts=$repo->findAll();
   
    if (!$contact) {
        $contact = new Contact ;
        // $contact->setDateEnregistrement(new \DateTime());
       
    }
    $form = $this->createForm(ContactFormType::class, $contact);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()){
       
        $manager->persist($contact);
        $manager->flush();
        $this->addFlash('success', 'La contact  a bien été Créer !');
        return $this->redirectToRoute('contact');
    }
    return $this->renderForm('main/contact.html.twig', [   
        'form' => $form,
        'contact'=>$contact,
        'contacts'=>$contacts
    ]);
}
#[Route("/avis", name:"avis")]
public function formAvis(AvisRepository $repo , EntityManagerInterface $manager, Request $request, Avis $avis = null)
{  $avis=$repo->findById($avis);

if (!$avis) {
    $avis = new Avis ;
    $avis->setDateEnregistrement(new \DateTime());
   
}
$form = $this->createForm(AvisFormType::class, $avis);
$form->handleRequest($request);
if ($form->isSubmitted() && $form->isValid()){
   
    $manager->persist($avis);
    $manager->flush();
    $this->addFlash('success', 'Avis  a bien été Créer !');
    return $this->redirectToRoute('avis');
}
return $this->renderForm('main/avis.html.twig', [   
    'form' => $form,
    'avis'=>$avis
]);
}
}