<?php

namespace App\Controller\Admin;

use App\Entity\Bebe;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BebeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Bebe::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titre'),
            TextEditorField::new('description')->onlyOnForms(),
            TextField::new('description')->renderAsHtml()->hideOnForm(),
            ColorField::new('couleur'),
            ChoiceField::new('taille')->setChoices(['S' => 'Small', 'M' => "Medium", 'L' => "Large"]),
            ChoiceField::new('collection')->setChoices(['Homme' => 'Homme', 'Femme' => 'Femme']),
            TextField::new('photo'),
            MoneyField::new('prix')->setCurrency('EUR'),
            NumberField::new('stock'),
            DateTimeField::new('dateEnregistrement')->setFormat('d/M/Y à H:m:s')->hideOnForm(),
            AssociationField::new('commandes', "Nombre de commandes de ce produit")->hideOnForm(),
        ];
    }

    public function createEntity(string $entityFqcn)
    {
        $pr = new $entityFqcn;
        $pr->setDateEnregistrement(new \DateTime);
        return $pr;
    }
}
