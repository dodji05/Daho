<?php

namespace App\Form;

use App\Entity\Ville;
use App\Entity\LieuxInterets;
use App\Form\ApplicationType;
use Doctrine\ORM\EntityRepository;
use App\Entity\CategorieLieuxInterets;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;


class LieuxInteretsType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class, $this->getConfiguration("Lieu d'interêt", "Entrez le nom du lieu d'interet ",  ['required' => true]))
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
            ->add('description')
            ->add('courteDescription')
            ->add('latitude',IntegerType::class, $this->getConfiguration("Latitude", "Coordonnes géographique : Latitude"))
            ->add('longitude',IntegerType::class, $this->getConfiguration("Longitude", "Coordonnes géographique : Longitude"))   
            // ->add('video', FileType::class, [
            //     'label' => 'Télécharger les videos',
            //     'multiple' => false,
            //     'mapped' => false,
            //     'required' => false
            // ]) 
             ->add('videoFile', VichImageType::class, [
                'label' => 'Video',
                'download_link' => false,
                'allow_delete'  => true,
                'required' => false
            ])
            ->add('img', FileType::class, [
                'label' => 'image',
                'multiple' => true,
                'mapped' => false,
                'required' => false
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
