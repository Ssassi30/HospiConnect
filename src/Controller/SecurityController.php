<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Form\LoginFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils, Request $request, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        // Récupérer l'erreur de connexion (s'il y en a une)
        $error = $authenticationUtils->getLastAuthenticationError();

        // Dernier email saisi par l'utilisateur
        $lastUsername = $authenticationUtils->getLastUsername();

        // Créer le formulaire de connexion avec l'email du dernier utilisateur
        $form = $this->createForm(LoginFormType::class, ['email' => $lastUsername]);

        // Traiter la soumission du formulaire si nécessaire
        $form->handleRequest($request);

        // Si le formulaire est soumis et valide, vérifier l'email et le mot de passe
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $email = $data['email'];
            $password = $data['password'];

            // Récupérer l'utilisateur par son email
            $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

            if ($user) {
                // Comparer le mot de passe en clair (sans hachage)
                if ($user->getMdp() === $password) {
                    // Stocker l'ID et le nom dans la session
                    $session->set('user_id', $user->getId());
                    $session->set('user_name', $user->getNom());
                    $session->set('user_First', $user->getPrenom());
                    $session->set('user_email', $user->getEmail());
                    $session->set('user_GS', $user->getGroupeSanguin());

                    // Rediriger vers le back office
                    return $this->redirectToRoute('back');
                } else {
                    // Mot de passe incorrect
                    $this->addFlash('error', 'Mot de passe incorrect');
                }
            } else {
                // Utilisateur non trouvé
                $this->addFlash('error', 'Aucun utilisateur trouvé avec cet email');
            }
        }

        // Rendu de la vue avec le formulaire et l'erreur de connexion si nécessaire
        return $this->render('BACKOFFICE/user/security/login.html.twig', [
            'loginForm' => $form->createView(),
            'error' => $error,
        ]);
    }

    #[Route('/logout', name: 'app_logout', methods: ['GET'])]
    public function logout(SessionInterface $session): RedirectResponse
    {
        // Supprimer les données de session si nécessaire
        $session->remove('user_id');
        $session->remove('user_email');

        // Redirection manuelle après la déconnexion
        return $this->redirectToRoute('login');
    }
}
