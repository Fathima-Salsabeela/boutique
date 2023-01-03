<?php

namespace App\Service;

use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class CartService
{
    private $rs;
    private $repo;
    private $flash;

    public function __construct(RequestStack $rs, ProduitRepository $repo, FlashBagInterface $flash)
    {
        $this->rs = $rs;
        $this->repo = $repo;
        $this->flash = $flash;
    }

    public function add($id)
    {
        $session = $this->rs->getSession();
        $cart = $session->get('cart', []);

        $produit = $this->repo->find($id);

        // je vérifie si j'ai assez de stock pour rajouter le produit dans mon panier

        if (!empty($cart[$id]) && $produit->getStock() <= $cart[$id]) {
            $this->flash->add('danger', "Il n'y a pas assez de stock.");
        } else {
            if (!empty($cart[$id])) {
                $cart[$id]++;
            } else {
                $cart[$id] = 1;
            }
            $session->set('cart', $cart);
        }
    }

    public function remove($id)
    {
        $session = $this->rs->getSession();
        $cart = $session->get('cart', []);

        if (!empty($cart[$id])) {
            unset($cart[$id]);
        }
        $session->set('cart', $cart);
    }

    public function decrement($id)
    {
        $session = $this->rs->getSession();
        $cart = $session->get('cart', []);

        if (!empty($cart[$id])) {
            if ($cart[$id] > 1) {
                $cart[$id]--;
            } else {
                unset($cart[$id]);
            }
        }
        /*
            si l'id du produit existe dans le panier :
                - soit sa qté est supérieure à 1, alors je décrémente
                - soit sa qté est égale à 1, alors je supprime le produit de mon panier
        */
        $session->set('cart', $cart);
    }

    public function empty()
    {
        $session = $this->rs->getSession();

        // solution 1 : remplacer le panier en session par un tableau vide
        $session->set('cart', []);

        // solution 2 : utiliser remove() pour supprimer un attribut de session
        // $session->remove('cart');

        // solution 3 : utiliser clear() pour supprimer TOUS LES ATTRIBUTS de session
        // $session->clear();
    }

    public function getCartWithData()
    {
        $session = $this->rs->getSession();
        $cart = $session->get('cart', []);

        $totalQuantity = 0;
        $cartWithData = [];

        foreach ($cart as $id => $quantity) {
            $cartWithData[] = [
                'product' => $this->repo->find($id),
                'quantity' => $quantity
            ];
            $totalQuantity += $quantity;
        }
        $session->set('totalQuantity', $totalQuantity);
        return $cartWithData;
    }

    public function getTotal()
    {
        $total = 0;
        $cartWithData = $this->getCartWithData();

        foreach ($cartWithData as $item) {
            $totalItem = $item['product']->getPrix() * $item['quantity'];
            $total += $totalItem;
        }
        return $total;
    }
}
