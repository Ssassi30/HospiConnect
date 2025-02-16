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

class AjoutType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id')
            ->add('nom')
            ->add('prenom')
            ->add('Mdp')
            ->add('date_n', DateType::class, [
                'widget' => 'single_text', // ✅ Correct ici
                'format' => 'yyyy-MM-dd',
            ])
            ->add('email')
            ->add('ZipCode')
            ->add('adresse')
            ->add('poids', NumberType::class, [
                'label' => 'Poids',
                'attr' => ['min' => 0, 'step' => 0.1], // Optional: setting a minimum value and step for decimal input
            ])
            ->add('taille', NumberType::class, [
                'label' => 'taille',
                'attr' => ['min' => 0, 'step' => 0.1], // Optional: setting a minimum value and step for decimal input
            ])
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
            ->add('sexe', ChoiceType::class, [
                'choices' => [
                    'Homme' => 'Homme',
                    'Femme' => 'Femme',
                ],
                'placeholder' => 'Choisir votre sexe', // Optional: Adds a placeholder to the dropdown
            ])
            ->add('groupeSanguin', ChoiceType::class, [
                'choices' => [
                    'A+' => 'A+',
                    'A-' => 'A-',
                    'B+' => 'B+',
                    'B-' => 'B-',
                    'AB+' => 'AB+',
                    'AB-' => 'AB-',
                    'O+' => 'O+',
                    'O-' => 'O-',
                ],
                'placeholder' => 'Choisir un Groupe Sanguin',
            ])
            ->add('tel')
            ->add('gouvernorat', ChoiceType::class, [
                'choices' => [
                    'Tunis' => 'Tunis',
                    'Ariana' => 'Ariana',
                    'Ben Arous' => 'Ben Arous',
                    'Manouba' => 'Manouba',
                    'Nabeul' => 'Nabeul',
                    'Zaghouan' => 'Zaghouan',
                    'Bizerte' => 'Bizerte',
                    'Beja' => 'Beja',
                    'Jendouba' => 'Jendouba',
                    'Kef' => 'Kef',
                    'Siliana' => 'Siliana',
                    'Kairouan' => 'Kairouan',
                    'Kasserine' => 'Kasserine',
                    'Sousse' => 'Sousse',
                    'Monastir' => 'Monastir',
                    'Mahdia' => 'Mahdia',
                    'Sfax' => 'Sfax',
                    'Gabes' => 'Gabes',
                    'Medenine' => 'Medenine',
                    'Tozeur' => 'Tozeur',
                    'Gafsa' => 'Gafsa',
                    'Tataouine' => 'Tataouine',
                    'La Manouba' => 'La Manouba',
                    'Djerba' => 'Djerba',
                ],
                'placeholder' => 'Choisir un gouvernorat',
            ])
;            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
