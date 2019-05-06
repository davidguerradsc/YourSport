<?php

namespace App\Form;


use App\Entity\Membre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfilFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            # Prénom
            ->add('prenom', TextType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => "Prenom",

                ]
            ])
            # Nom
            ->add('nom', TextType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => "Nom",

                ]
            ])
            # Pseudo
            ->add('pseudo', TextType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => "Pseudo",
                ]
            ])

            # Ville
            ->add('ville', TextType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => "Ville",

                ]
            ])
            # Département
            ->add('departement', TextType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => "Département",

                ]
            ])
            # Email
            ->add('email', EmailType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => "Adresse email",
                ]
            ])
            # Bouton submit
            ->add('submit', SubmitType::class, [
                'label' => 'Editer',
                'attr' => [
                    'class' => 'myButton'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', Membre::class);
    }
}