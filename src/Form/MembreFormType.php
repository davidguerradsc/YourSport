<?php


namespace App\Form;


use App\Entity\Membre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
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
            ->add('prenom', TextType::class,[
                'required'  => true,
                'label'     => false,
                'attr'      => [
                    'placeholder' => "Saisissez votre prénom !"
                ]
            ])

            # Nom
            ->add('nom', TextType::class,[
                'required'  => true,
                'label'     => false,
                'attr'      => [
                    'placeholder' => "Saisissez votre nom !"
                ]
            ])

            # Pseudo
            ->add('pseudo', TextType::class,[
                'required'  => true,
                'label'     => false,
                'attr'      => [
                    'placeholder' => "Saisissez votre pseudo !"
                ]
            ])

            # Email
            ->add('pseudo', EmailType::class,[
                'required'  => true,
                'label'     => false,
                'attr'      => [
                    'placeholder' => "Saisissez votre email !"
                ]
            ])

            # Password
            ->add('password', PasswordType::class,[
                'required'  => true,
                'label'     => false,
                'attr'      => [
                    'placeholder' => "Saisissez votre mot de passe !"
                ]
            ])

            # Date de naissance
            ->add('date_de_naissance', BirthdayType::class,[
                'required'  => true,
                'label'     => false,
                'attr'      => [
                    'placeholder' => "Saisissez votre date de naissance !"
                ]
            ])

            # Ville
            ->add('ville', TextType::class,[
                'required'  => true,
                'label'     => false,
                'attr'      => [
                    'placeholder' => "Saisissez votre département !"
                ]
            ])

            # Bouton submit
            ->add('submit', SubmitType::class,[
                'label'     => 'S\'Inscrire'
            ])
        ;

    }

    # Securite pour etre sur que seul une instance membre est passé
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class',Membre::class);
    }

}