<?php

namespace App\Controller;

use App\Repository\SectionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, SectionRepository $sectionRepository): Response
    {
        // Redirectare dacă utilizatorul este deja autentificat
        if ($this->getUser()) {
            return $this->redirectToRoute('coucou'); // Asigură-te că ruta 'coucou' este definită
        }

        // Obține eroarea de autentificare dacă există
        $error = $authenticationUtils->getLastAuthenticationError();

        // Ultimul username introdus de utilizator
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'title' => "Connexion",
            'sections' => $sectionRepository->findAll(), // Asigură-te că ai o entitate Section
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        // Este gestionat de Symfony, nu trebuie implementat
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
