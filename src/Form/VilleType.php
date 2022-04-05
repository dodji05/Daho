<?php

namespace App\Form;

use App\Entity\Ville;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Form\ApplicationType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class VilleType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name' ,TextType::class, $this->getConfiguration("Nom de la ville", "entrez le nom de la ville",  ['required' => true]))
           // ->add('images', CollectionType::class, ['entry_type' => ImageVilleType::class, 'allow_add' => true, 'allow_delete' => true]) 
           ->add('img', FileType::class, [
            'label' => 'image de la ville',
            'multiple' => true,
            'mapped' => false,
            'required' => false
        ])
            ->add('description',TextareaType::class, $this->getConfiguration("Description", "saissez une breve description de la ville"))
            ->add('video',TextType::class, $this->getConfiguration("Video", "une video de presentation de la ville "))
           
            ->add('latitude',TextType::class, $this->getConfiguration("Latitude", "Coordonnes géographique : latitude"))

            ->add('longitude',TextType::class, $this->getConfiguration("Longitude", "Coordonnes géographique : Longitude"))
            ->add('status')
          
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ville::class,
        ]);
    }
}
