<?php

namespace App\Form;

use App\Entity\Operation;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType; // Ajouter cette ligne pour inclure le bouton submit
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('date_n', DateType::class, [
                'widget' => 'single_text', // ✅ Correct ici
                'format' => 'yyyy-MM-dd',
            ])
            ->add('email')
            ->add('role', ChoiceType::class, [
                'choices' => [
                    'Médecin' => 'medecin',
                    'Donateur' => 'donateur',
                    'Patient' => 'patient',
                    'Administrateur' => 'Administrateur',
                    'Personnel' => 'personnel',
                ],
                'placeholder' => 'Choisir un rôle', // Optional: Adds a placeholder to the dropdown
            ])
            ->add('Mdp')
;            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
