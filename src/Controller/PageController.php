<?php

namespace App\Controller;

use App\Repository\SnippetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'app_page')]
    public function index(
        SnippetRepository $snippets
    ): Response {
        return $this->render('page/index.html.twig', [
            'snippets' => $snippets->findBy(
                ['isPublished' => true],
                ['createdAt' => 'DESC'],
                10 // Pour limiter l'affichage
            )
            ]);
    }
}
