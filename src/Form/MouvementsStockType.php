<?php

namespace App\Form;

use App\Entity\MouvementsStock;
use App\Entity\Materiel;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MouvementStockType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('id_materiel', EntityType::class, [
                'class' => Materiel::class,
                'choice_label' => 'nom', // Affiche le nom du matériel dans la liste déroulante
                'choice_value' => 'id', // Utilise l'ID du matériel comme valeur sélectionnée
            ])
            ->add('id_personnel', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'nom', // Affiche le nom d'utilisateur dans la liste déroulante
                'choice_value' => 'id', // Utilise l'ID de l'utilisateur comme valeur sélectionnée
            ])
            ->add('id_mouvement', IntegerType::class, [
                'label' => 'ID Mouvement',
                'required' => true, // Ou false si facultatif
            ])
            ->add('typeMouvement', ChoiceType::class, [
                'label' => 'Type de Mouvement',
                'choices' => [
                    'Entrée' => 'Entrée',
                    'Sortie' => 'Sortie',
                    'Reparation' => 'Reparation',
                ],
                'placeholder' => 'Sélectionnez un type', // Optionnel
            ])
            ->add('qunatite', IntegerType::class)
            ->add('date_mouvement', DateType::class, [
                'widget' => 'single_text', // Affiche un sélecteur de date
            ])
            ->add('motif', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MouvementsStock::class,
        ]);
    }
}