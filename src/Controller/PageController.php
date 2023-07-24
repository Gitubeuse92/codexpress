<?php

namespace App\Controller;

use App\Repository\SnippetRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PageController extends AbstractController
{
    #[Route('/', name: 'app_page')]
    public function index(
        SnippetRepository $snippets,
        PaginatorInterface $paginator, // Chargement de PaginatorInterface
        Request $request // Chargement de Request
        
    ): Response {
        $query = $snippets->findBy(
            ['isPublished' => true],
            ['createdAt' => 'DESC'],
            100 // Pour limiter l'affichage
        );
            
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        return $this->render('page/index.html.twig', [
            'snippets' => $pagination
            ]);
    }
}
