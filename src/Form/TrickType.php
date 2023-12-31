<?php

namespace App\Form;

use App\Entity\Trick;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, array('label' => 'Nom : '))
            ->add('content', TextareaType::class, array('label' => 'Description : '))
            ->add('photos', FileType::class, array('label' => 'Images : ', 'multiple' => true, 'mapped'=> false))
            ->add('videos', CollectionType::class, array('entry_type' => VideoType::class, 'label' => false,'allow_add' => true,'allow_delete' => true, 'by_reference' => false,))
            ->add('groupe', TextType::class, array('label' => 'Groupe : ', 'mapped'=> false))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
