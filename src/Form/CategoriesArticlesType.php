<?php

namespace App\Form;

use App\Entity\CategoriesArticles;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoriesArticlesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
                'label'=>'Catégorie',
                'attr'=>[
                    'placeholder'=>'Nom de la catégorie'
                ]
            ])

            ->add('parent',EntityType::class,[
                'class' =>CategoriesArticles::class,
                'choice_label' =>'nom',
                'placeholder'=>'Sélectionner la catégorie parente',
                'label'=>'Catégorie parente',
                'required'=>false
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CategoriesArticles::class,
        ]);
    }
}
