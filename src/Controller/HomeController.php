<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('front/home.html.twig');
    }

    #[Route('/info', name: 'info')]
    public function info(): Response
    {
        return $this->render('front/info.html.twig');
    }

    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('front/contact.html.twig');
    }

    #[Route('/articles', name: 'articles')]
    public function articles(): Response
    {
        return $this->render('admin/articles.html.twig');
    }

}

