<?php

namespace App\Form;

use App\Entity\Membre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConnexionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $formbuilder, array $options)
    {
        $formbuilder
            ->add('email', EmailType::class,[
                'label' => false,
                'attr'  => ['placeholder' => 'Email']
        ])

            ->add('password', PasswordType::class, [
            'label' => false,
            'attr'  => ['placeholder' => 'Mot de passe']
        ])

            ->add('submit',
            SubmitType::class, [
            'label' => 'connexion'
        ]);

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => null,
        ]);

    }



}