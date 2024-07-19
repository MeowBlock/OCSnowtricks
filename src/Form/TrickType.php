<?php

namespace App\Form;

use App\Entity\Groupe;
use App\Entity\Trick;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class TrickType extends AbstractType
{

    public function __construct(
        protected EntityManagerInterface $entityManager
    ) {
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $groupRepository = $this->entityManager->getRepository(Groupe::class);
        $choices = $groupRepository->findAll();
        $builder
            ->add('name', TextType::class, array('label' => 'Nom : '))
            ->add('content', TextareaType::class, array('label' => 'Description : '))
            ->add('photos', FileType::class, array('label' => 'Images : ', 'multiple' => true, 'mapped'=> false, 'required' => false))
            ->add('videos', CollectionType::class, array('entry_type' => VideoType::class, 'label' => false,'allow_add' => true,'allow_delete' => true, 'by_reference' => false,))
            ->add('groupe', ChoiceType::class, array('label' => 'Groupe : ', 'mapped'=> true, 'choices' => $choices, 'choice_label'=>'name'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
