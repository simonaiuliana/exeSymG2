<?php


// src/Controller/AdminController.php

namespace App\Controller;

use App\Entity\Admin;
use App\Form\AdminType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AdminController extends AbstractController
{
    #[Route('/create-admin', name: 'create_admin')]
    public function createAdmin(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
        $admin = new Admin();
        $form = $this->createForm(AdminType::class, $admin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $admin->getPassword();
            $hashedPassword = $passwordHasher->hashPassword($admin, $plainPassword);
            $admin->setPassword($hashedPassword);
            $admin->setCreatedAt(new \DateTime()); // Setează data curentă
            $admin->setActive(true); // Setează utilizatorul ca activ

            $entityManager->persist($admin);
            $entityManager->flush();

            return $this->redirectToRoute('admin_success'); // Schimbă în ruta dorită
        }

        return $this->render('admin/create_admin.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/articles', name: 'admin_articles')]
    public function articles(): Response
    {
        // Aici ar trebui să obții articolele din baza de date.
        // Deocamdată, vom returna un răspuns simplu.

        return $this->render('admin/articles.html.twig', [
            // Trebuie să pasezi articolele din baza de date aici
        ]);
    }
}

