<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\SigninType;
use App\Form\AjoutType;
use App\Form\ModifierType;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TESTController extends AbstractController
{
    #[Route('/back', name: 'back')]
    public function back(): Response
    {
        return $this->render('BACKOFFICE/main-back/back-base.html.twig');
    }

    #[Route('/front', name: 'front')]
    public function front(): Response
    {
        return $this->render('FRONTOFFICE/main-front/index.html.twig');
    }

    #[Route('/signin', name: 'signin')]
    public function signin(Request $request, EntityManagerInterface $entityManager): Response
    {
        $users = $entityManager->getRepository(User::class)->findAll();

        // Créer un nouvel objet User pour le formulaire d'ajout
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        // Vérifier si le formulaire est soumis
        if ($form->isSubmitted()) {
            // Récupérer les valeurs du mot de passe et de la confirmation du mot de passe
            $mdp = $form->get('Mdp')->getData();
            $confirmMdp = $request->get('confirmMdp'); // Récupérer le mot de passe de confirmation

            // Vérifier si les mots de passe correspondent
            if ($mdp !== $confirmMdp) {
                // Ajouter un message flash si les mots de passe ne correspondent pas
                $this->addFlash('error', 'Les mots de passe ne correspondent pas.');

                // Rediriger vers le formulaire de connexion (ou la même page)
                return $this->redirectToRoute('signin');
            }

            // Ajouter les valeurs par défaut
            $user->setDateC(new \DateTime());
            $user->setStatutCompte("Horsligne");
            $user->setEmpreinte("******");
            $user->setInactivite((new \DateTime())->modify('-10 seconds'));

            // Sauvegarder dans la base de données
            $entityManager->persist($user);
            $entityManager->flush();

            // Message flash de confirmation
            $this->addFlash('success', 'Utilisateur ajouté avec succès !');

            // Redirection pour éviter la resoumission du formulaire
            return $this->redirectToRoute('user');
        }

        // Rendu de la vue avec les utilisateurs et le formulaire
        return $this->render('BACKOFFICE/user/security/Signin.html.twig', [
            'users' => $users,
            'form' => $form->createView(),
        ]);
    }



    #[Route('/apropos', name: 'apropos')]
    public function apropos(): Response
    {
        return $this->render('FRONTOFFICE/main-front/apropos.html.twig');
    }

    #[Route('/FP', name: 'FP')]
    public function FP(): Response
    {
        return $this->render('BACKOFFICE/user/security/FP.html.twig');
    }

    #[Route('/profile', name: 'profile')]
    public function profile(): Response
    {
        return $this->render('BACKOFFICE/user/profile.html.twig');
    }

    #[Route('/Setting1', name: 'Setting1')]
    public function Setting1(): Response
    {
        return $this->render('BACKOFFICE/user/Setting1.html.twig');
    }

    #[Route('/Connections', name: 'Connections')]
    public function Connections(): Response
    {
        return $this->render('BACKOFFICE/user/Connections.html.twig');
    }

    #[Route('/user', name: 'user')]
    public function user(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Récupérer tous les utilisateurs pour les afficher
        $users = $entityManager->getRepository(User::class)->findAll();

        // Créer un nouvel objet User pour le formulaire d'ajout
        $user = new User();
        $form = $this->createForm(AjoutType::class, $user);
        $form->handleRequest($request);

        $user1 = new User();
        $formModifier = $this->createForm(ModifierType::class, $user1);
        $formModifier->handleRequest($request);

        // Vérifier si le formulaire est soumis et valide
        if ($form->isSubmitted()) {
            // Ajouter les valeurs par défaut
            $user->setDateC(new \DateTime());
            $user->setMdp("ChangeMe");
            $user->setStatutCompte("Horsligne");
            $user->setEmpreinte("******");
            $user->setInactivite((new \DateTime())->modify('-10 seconds'));

            // Sauvegarder dans la base de données
            $entityManager->persist($user);
            $entityManager->flush();

            // Message flash de confirmation
            $this->addFlash('success', 'Utilisateur ajouté avec succès !');

            // Redirection pour éviter la resoumission du formulaire
            return $this->redirectToRoute('user');
        }

        // Rendu de la vue avec les utilisateurs et le formulaire
        return $this->render('BACKOFFICE/user/user.html.twig', [
            'users' => $users,
            'form' => $form->createView(),
            'formModifier' => $form->createView(),
        ]);
    }

    #[Route('/user/delete/{id}', name: 'delete_user', methods: ['POST'])]
    public function deleteUser($id, EntityManagerInterface $entityManager): Response
    {
        // Vérifier que l'ID est valide
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            // Retourner une erreur si l'utilisateur n'est pas trouvé
            return $this->json([
                'message' => 'Utilisateur introuvable'
            ], Response::HTTP_NOT_FOUND);
        }

        // Supprimer l'utilisateur
        $entityManager->remove($user);
        $entityManager->flush();

        // Retourner une réponse JSON avec un message de succès
        return $this->json([
            'message' => 'Utilisateur supprimé avec succès'
        ]);
    }

    #[Route('/user/edit/{id}', name: 'edit_user')]
    public function editUser(Request $request, EntityManagerInterface $entityManager, $id): Response
    {
        // Récupérer l'utilisateur à modifier
        $user = $entityManager->getRepository(User::class)->find($id);

        // Vérifier si l'utilisateur existe
        if (!$user) {
            // Si l'utilisateur n'existe pas, afficher une erreur ou rediriger
            $this->addFlash('error', 'Utilisateur introuvable.');
            return $this->redirectToRoute('user');
        }

        // Créer le formulaire avec les données de l'utilisateur
        $Modifier = $this->createForm(ModifierType::class, $user);
        $Modifier->handleRequest($request);

        // Vérifier si le formulaire a été soumis et est valide
        if ($Modifier->isSubmitted() && $Modifier->isValid()) {
            // Sauvegarder les modifications dans la base de données
            $entityManager->flush();

            // Message flash de confirmation
            $this->addFlash('success', 'Utilisateur modifié avec succès !');

            // Redirection après la modification
            return $this->redirectToRoute('user');
        }

        // Rendre la vue avec le formulaire de modification
        return $this->render('BACKOFFICE/user/user.html.twig', [
            'formModifier' => $Modifier->createView(),
        ]);
    }

    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('FRONTOFFICE/main-front/contact.html.twig');
    }

    #[Route('/CP', name: 'CP')]
    public function CP(): Response
    {
        return $this->render('BACKOFFICE/user/security/CP.html.twig');
    }

    #[Route('/Maintenance', name: 'Maintenance')]
    public function Maintenance(): Response
    {
        return $this->render('BACKOFFICE/user/Maintenance.html.twig');
    }
}
