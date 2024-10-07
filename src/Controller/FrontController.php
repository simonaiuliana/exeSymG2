<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(): Response
    {
        return $this->render('front/home.html.twig');
    }
    
    #[Route('/articles', name: 'articles')]
    public function articles(): Response
    {
        // Récupérer les articles depuis la base de données
        // $articles = ...

        return $this->render('admin/articles.html.twig', [
            // 'articles' => $articles,
        ]);
    }
}
