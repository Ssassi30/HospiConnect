<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function signin(): Response
    {
        return $this->render('BACKOFFICE/user/security/Signin.html.twig');
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
    public function user(): Response
    {
        return $this->render('BACKOFFICE/user/user.html.twig');
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
}
