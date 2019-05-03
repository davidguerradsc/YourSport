<?php

namespace App\Form;

use App\Entity\Evenement;
use App\Entity\Sports;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            # TITRE
            ->add('titre', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => "Titre de l'événement"
                ]
            ])
            # SPORTS
            ->add('sport', EntityType::class, [
                'class' => Sports::class,
                'choice_label' => 'nom',
                'label' => false,
            ])
            # VILLE
            ->add('ville', TextType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => "Saisir la ville"
                ]
            ])
            # DEPARTEMENT
            ->add('departement', TextType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => "Saisissez le département"
                ]
            ])
            # LIEU
            ->add('lieu', TextType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => "Lieu de l'événement"
                ]
            ])
            # ADRESSE
            ->add('adresse', TextType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => "Adresse de l'événement (optionnel)"
                ]
            ])
            # DETAILS
            ->add('details', TextType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => "Détails additionnnel (optionnel)"
                ]
            ])
            # DATE
            ->add('date', DateType::class, [
                'required' => true,
                'widget' => 'single_text',
                'label' => 'Date de l\'événement :',
            ])
            # HEURE
            ->add('heure', TimeType::class, [
                'required' => true,
                'widget' => 'single_text',
                'label' => 'Heure de l\'événement :',
            ])
            # Bouton submit
            ->add('submit', SubmitType::class, [
                'label' => 'Créer',
                'attr' => [
                    'class' => 'myButton'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', Evenement::class);
    }

}
