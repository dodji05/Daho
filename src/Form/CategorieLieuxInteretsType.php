<?php

namespace App\Form;

use App\Form\ApplicationType;
use App\Entity\CategorieLieuxInterets;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CategorieLieuxInteretsType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class, $this->getConfiguration("Catégorie lieu d'interet", "Entrez le nom de la catégorie du lieu d'interet",  ['required' => true]))
            ->add('status')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CategorieLieuxInterets::class,
        ]);
    }
}
