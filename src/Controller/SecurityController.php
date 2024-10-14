<?php

namespace App\Controller;

use App\Repository\SectionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login/admin', name: 'app_login_admin')]
    public function adminLogin(AuthenticationUtils $authenticationUtils, SectionRepository $sectionRepository): Response
    {
        // Redirect if the user is already authenticated
        if ($this->getUser()) {
            return $this->redirectToRoute('coucou'); // Ensure that the 'coucou' route is defined
        }

        // Get the last authentication error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // Last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/admin_login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'title' => "Admin Login",
            'sections' => $sectionRepository->findAll(), // Ensure you have a Section entity
        ]);
    }

    #[Route(path: '/login/user', name: 'app_login_user')]
    public function userLogin(AuthenticationUtils $authenticationUtils, SectionRepository $sectionRepository): Response
    {
        // Redirect if the user is already authenticated
        if ($this->getUser()) {
            return $this->redirectToRoute('coucou'); // Ensure that the 'coucou' route is defined
        }

        // Get the last authentication error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // Last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/user_login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'title' => "User Login",
            'sections' => $sectionRepository->findAll(), // Ensure you have a Section entity
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        // This method is intercepted by the logout key on your firewall
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
