<?php

namespace App\Form;

use App\Entity\Ad;
use App\Entity\Booking;
use App\Entity\User;
use App\Form\DataTransformer\FrenchToDateTimeTransformer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminBookingType extends ApplicationType
{
    private $transformer;

    public function __construct(FrenchToDateTimeTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startDate', TextType::class,
                $this->getConfiguration('Date d\'arrivée', 'Entrez votre date d\'arrivée'
                ))
            ->add('endDate', TextType::class,
                $this->getConfiguration('Date de départ', 'Entrez votre date de départ'
                ))
            ->add('comment', TextareaType::class,
                $this->getConfiguration('Commentaire', 'Entrez votre commentaire', ['required' => false]
                ))
            ->add('booker', EntityType::class,
                $this->getConfiguration('Visiteur', 'Choisissez votre visiteur', [
                    'class' => User::class,
                    'choice_label' => function($user) {
                        return $user->getFirstName() . " " . strtoupper($user->getLastName());
                    }
            ]))
            ->add('ad', EntityType::class,
                $this->getConfiguration('Annonce', 'Choisissez votre annonce', [
                    'class' => Ad::class,
                    'choice_label' => 'title'
            ]))
        ;

        $builder->get('startDate')->addModelTransformer($this->transformer);
        $builder->get('endDate')->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
