<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email', EmailType::class, array('attr' => array('class' => 'is-medium is-rounded input', 'placeholder'=> 'hello@example.com'), 'label' => 'Adresse email'))
        ->add('name', TextType::class, array('attr' => array('class' => 'is-medium is-rounded input', 'placeholder'=> 'Xx_SnowBoarder_xX'), 'label' => 'Nom d\'utilisateur'))
        ->add('avatar', FileType::class, array('attr' => array('class' => 'is-medium is-rounded input', 'placeholder'=> 'Avatar'), 'mapped'=> false, 'required' => false, 'label' => 'Photo de profil'))
        ->add('password', RepeatedType::class, [
            'type' => PasswordType::class,
            'invalid_message' => 'Les deux mots de passe doivent correspondre.',
            'required' => true,
            'first_options'  => ['label' => 'Mot de passe', 'attr' => array('class' => 'is-medium is-rounded input', 'placeholder'=> '**********'),],
            'second_options' => ['label' => 'Tapez le mot de passe à nouveau', 'attr' => array('class' => 'is-medium is-rounded input', 'placeholder'=> '**********'),],
        ],)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
