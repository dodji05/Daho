<?php

namespace App\Form;

use App\Entity\Articles;
use App\Entity\CategoriesArticles;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticlesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class,[
                "attr"=>[
                    "placeholder"=>"Titre de l'article",
                ]
            ])
            ->add('contenu',TextareaType::class)

            ->add('imageArticle', FileType::class, [
                'label' => 'Image',
                'data_class' => null
            ])
            ->add('categorie', EntityType::class,[
                'class' => CategoriesArticles::class,
                'choice_label' =>'nom',
                'placeholder'=>'Sélectionner la catégorie parente',
                'multiple' => true,
                'expanded' => true
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,
        ]);
    }
}
