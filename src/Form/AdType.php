<?php

namespace App\Form;

use App\Entity\Ad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class, $this->getConfiguration('Titre', 'Entrez votre titre'))
            ->add('slug',TextType::class, $this->getConfiguration('Slug', 'Entrez votre slug'))
            ->add('coverImage', UrlType::class, $this->getConfiguration('URL de l\'image', 'Entrez votre url de l\'image'))
            ->add('introduction', TextType::class, $this->getConfiguration('Introduction', 'Entrez votre introduction'))
            ->add('content', TextareaType::class, $this->getConfiguration('Description', 'Entrez votre description'))
            ->add('rooms', IntegerType::class, $this->getConfiguration('Nombre de chambres', 'Entrez votre nombre de chambres'))
            ->add('price',MoneyType::class, $this->getConfiguration('Prix par nuit', 'Entrez votre prix par nuit'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }

    /**
     * Permet d'avoir la configuration de base d'un champ
     *
     * @param string $label
     * @param string $placeholder
     * @return array
     */
    private function getConfiguration($label, $placeholder) {
        return [
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
        ];
    }
}
