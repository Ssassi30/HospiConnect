<?php



namespace App\Form;

use App\Entity\Materiel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Positive;

class MaterielType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id_materiel', IntegerType::class, [
                'label' => 'ID Matériel', 
                'constraints' => [
                    new NotBlank(['message' => 'L\'ID Matériel est obligatoire.']),
                ],
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom du Matériel',
                'constraints' => [
                    new NotBlank(['message' => 'Le nom du matériel est obligatoire.']),
                    new Length([
                        'max' => 5,
                        'min' => 2,
                        'maxMessage' => 'Le nom ne doit pas dépasser {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('categorie', TextType::class, [
                'label' => 'Catégorie',
                'constraints' => [
                    new NotBlank(['message' => 'La catégorie est obligatoire.']),
                ],
            ])
            ->add('etat', ChoiceType::class, [
                'label' => 'État du Matériel',
                'choices' => [
                    'Usage' => 'usage',
                    'Neuf' => 'neuf',
                    'Hors Service' => 'hors_service',
                ],
                'constraints' => [
                    new NotBlank(['message' => 'L\'état du matériel est obligatoire.']),
                ],
            ])
            ->add('quantite', IntegerType::class, [
                'label' => 'Quantité',
                'constraints' => [
                    new NotBlank(['message' => 'La quantité est obligatoire.']),
                    new Positive(['message' => 'La quantité doit être un nombre positif.']),
                ],
            ])
            ->add('emplacement', TextType::class, [
                'label' => 'Emplacement',
                'constraints' => [
                    new NotBlank(['message' => 'L\'emplacement est obligatoire.']),
                ],
            ])
            ->add('date_ajout', DateType::class, [
                'label' => 'Date d\'Ajout',
                'widget' => 'single_text',
               
                'constraints' => [
                    new NotBlank(['message' => 'La date d\'ajout est obligatoire.']),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Materiel::class,
        ]);
    }
}