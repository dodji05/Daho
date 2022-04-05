<?php

namespace App\Form;

use App\Entity\Ville;
use App\Entity\LieuxInterets;
use Doctrine\ORM\EntityRepository;
use App\Entity\CategorieLieuxInterets;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class LieuxInteretsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('video')
            ->add('img', FileType::class, [
                'label' => 'image',
                'multiple' => true,
                'mapped' => false,
                'required' => false
            ])
            ->add('latitude')
            ->add('longitude')           
           
            ->add('ville',EntityType::class,[
                'class' =>Ville::class,
                'choice_label' =>'name',
                'placeholder'=>'Sélectionner la ville',
                'label'=>'Ville',
                'required'=>true
            ])
            ->add('categorie',EntityType::class,[
                'class' =>CategorieLieuxInterets::class,
                'choice_label' =>'name',
                'placeholder'=>'Sélectionner la catégorie ',
                'label'=>'Catégorie lieu d\'interet',
                "query_builder"=>function(EntityRepository $er){
                    return $er->createQueryBuilder('c')                  
                    ->where('c.status = :val')
                    ->setParameter('val', true)
                   
                    ;
                },
                'required'=>true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LieuxInterets::class,
        ]);
    }
}
