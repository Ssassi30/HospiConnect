<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Form\LoginFormType;
use App\Form\SignInFormType;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // Récupérer l'erreur de connexion (s'il y en a une)
        $error = $authenticationUtils->getLastAuthenticationError();

        // Dernier email saisi par l'utilisateur
        $lastUsername = $authenticationUtils->getLastUsername();

        // Création du formulaire
        $form = $this->createForm(LoginFormType::class, ['email' => $lastUsername]);

        return $this->render('BACKOFFICE/user/security/login.html.twig', [
            'loginForm' => $form->createView(),
            'error' => $error,
        ]);
    }


    #[Route('/logout', name: 'app_logout', methods: ['GET'])]
    public function logout(): void
    {
        // Symfony gère automatiquement la déconnexion avec le firewall
        throw new \LogicException('Ce point de sortie sera intercepté par le firewall.');
    }
}
