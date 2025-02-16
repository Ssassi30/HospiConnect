<?php

namespace App\Controller;

use App\Entity\user;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationController extends AbstractController
{
    private $passwordHasher;
    private $entityManager;

    public function __construct(UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager)
    {
        $this->passwordHasher = $passwordHasher;
        $this->entityManager = $entityManager;
    }

    #[Route('/register', name: 'register')]
    public function register(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer et assigner les données du formulaire
            $user->setNom($form->get('nom')->getData());
            $user->setPrenom($form->get('prénom')->getData());
            $user->setDateN($form->get('date_de_naissance')->getData());
            $user->setEmail($form->get('email')->getData());

            // Vérifier si les mots de passe correspondent
            $password = $form->get('password')->getData();
            $passwordConfirm = $form->get('password1')->getData();
            if ($password !== $passwordConfirm) {
                $this->addFlash('danger', 'Les mots de passe ne correspondent pas.');
                return $this->render('registration/register.html.twig', [
                    'form' => $form->createView(),
                ]);
            }

            // Encoder le mot de passe
            $hashedPassword = $this->passwordHasher->hashPassword($user, $password);
            $user->setMdp($hashedPassword); // Utilisation de setPassword()

            // Sauvegarder l'utilisateur en base de données
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            // Redirection après inscription réussie
            $this->addFlash('success', 'Inscription réussie ! Vous pouvez maintenant vous connecter.');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
