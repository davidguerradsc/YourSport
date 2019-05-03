<?php


namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ContactFormType extends AbstractType
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


            #Email
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Email']
            ])


            #Message
            ->add('message', TextareaType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Message']
                ])


            #Submit
            ->add('submit',
                SubmitType::class, [
                    'label' => 'Envoyer',
                    'attr' => [
                        'class' => 'myButton'
                    ]
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class' , Contact::class);
    }

}