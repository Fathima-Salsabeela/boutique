<?php

namespace App\Controller\Admin;

use App\Entity\Avis;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AvisCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Avis::class;
    }

    public function configureActions(Actions $actions): Actions
    {
    return $actions->remove(Crud::PAGE_INDEX, Action::NEW);
    }
    

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('pseudo'),
            TextField::new('ville'),
            NumberField::new('codepostal'),
            TextField::new('suject'),
            NumberField::new('point'),
            DateTimeField::new('date_enregistrement')->setFormat('d/M/Y à H:m:s'),
        ];
    }

    public function createEntity(string $entityFqcn)
    { 
        $pr = new $entityFqcn;
        $pr->setDateEnregistrement(new \DateTime);
        return $pr;
    }

    
}
