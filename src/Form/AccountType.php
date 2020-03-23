<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccountType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, $this->getConfiguration('Prénom', 'Entrez votre prénom'))
            ->add('lastName', TextType::class, $this->getConfiguration('Nom', 'Entrez votre nom'))
            ->add('email', EmailType::class, $this->getConfiguration('Email', 'Entrez votre email'))
            ->add('picture', UrlType::class, $this->getConfiguration('Avatar', 'Entrez l\'url de votre avatar'))
            ->add('introduction', TextType::class, $this->getConfiguration('Introduction', 'Entrez votre introduction'))
            ->add('description', TextareaType::class, $this->getConfiguration('Description détaillée', 'Entrez votre description détaillée'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
