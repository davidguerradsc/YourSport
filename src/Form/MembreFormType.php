<?php


namespace App\Form;


use App\Entity\Membre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MembreFormType extends AbstractType
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
            # Email
            ->add('email', EmailType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => "Adresse email",
                ]
            ])
            # Password
            ->add('password', PasswordType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => "Mot de passe",

                ]
            ])
            # Date de naissance
            ->add('date_de_naissance', DateType::class, [
                'required' => true,
                'label' => 'Date de Naissance :',
                'widget' => 'single_text',
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
            # Bouton submit
            ->add('submit', SubmitType::class, [
                'label' => 'S\'inscrire',
            ]);

    }

    # Securite pour etre sur que seul une instance membre est passé
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', Membre::class);
    }

}