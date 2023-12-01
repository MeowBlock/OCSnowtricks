<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email', EmailType::class, array('attr' => array('class' => 'is-medium is-rounded input', 'placeholder'=> 'hello@example.com')))
        ->add('name', TextType::class, array('attr' => array('class' => 'is-medium is-rounded input', 'placeholder'=> 'Xx_SnowBoarder_xX')))
        ->add('avatar', FileType::class, array('attr' => array('class' => 'is-medium is-rounded input', 'placeholder'=> 'Avatar'), 'mapped'=> false))
        ->add('password', PasswordType::class, array('attr' => array('class' => 'is-medium is-rounded input', 'placeholder'=> '**********')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
