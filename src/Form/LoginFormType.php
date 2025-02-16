<?php

namespace App\Form;
use App\Entity\Operation;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class LoginFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email ou Téléphone',
                'attr' => ['placeholder' => 'Email ou Téléphone']
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de Passe',
                'attr' => ['placeholder' => '••••••••']
            ])
            ->add('remember_me', CheckboxType::class, [
                'label'    => 'Souvenir de moi',
                'required' => false,
            ])
            
            ->add('remember_me', CheckboxType::class, [
                'label'    => 'Se souvenir de moi',
                'required' => false,
                'mapped'   => false, // Empêche la liaison avec l'entité User
            ]);
            
    }

}
