<?php

namespace App\Form;

    use App\Entity\Evenement;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
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
            # SLUG
            ->add('slug', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => "slug"
                ]
            ])
            # VILLE
            ->add('ville', TextType::class,[
                'required'  => true,
                'label'     => false,
                'attr'      => [
                    'placeholder' => "Saisir la ville"
                ]
            ])
            # DEPARTEMENT
            ->add('departement', TextType::class,[
                'required'  => true,
                'label'     => false,
                'attr'      => [
                    'placeholder' => "Saisissez le département"
                ]
            ])
            # LIEU
            ->add('lieu', TextType::class,[
                'required'  => true,
                'label'     => false,
                'attr'      => [
                    'placeholder' => "Lieu de l'événement"
                ]
            ])
            # ADRESSE
            ->add('adresse', TextType::class,[
                'required'  => true,
                'label'     => false,
                'attr'      => [
                    'placeholder' => "Adresse de l'événement"
                ]
            ])
            # DETAILS
            ->add('details', TextType::class,[
                'required'  => true,
                'label'     => false,
                'attr'      => [
                    'placeholder' => "Détails additionnnel"
                ]
            ])
            # DATE
            ->add('date', DateTimeType::class,[
                'required'  => true,
                'label'     => false,
                'attr'      => [
                    'placeholder' => "Date de l'événement"
                ]
            ])
            # HEURE
            ->add('heure', TimeType::class,[
                'required'  => true,
                'label'     => false,
                'attr'      => [
                    'placeholder' => "Heure de l'événement"
                ]
            ])

            # Bouton submit
            ->add('submit', SubmitType::class,[
                'label'     => 'Créer Evénement'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', Evenement::class);
    }

}
