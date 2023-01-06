<?php

namespace App\Form;

use App\Entity\Avis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AvisFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudo')
            ->add('ville')
            ->add('codepostal')
            ->add('suject')
            ->add('point')
            ->add('date_enregistrement')
        ;
    }
   public function configureOptions(OptionsResolver $resolver): void
   {
       $resolver->setDefaults([
           'data_class' => Avis::class,
       ]);
   }
    
    
    }

