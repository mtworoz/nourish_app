<?php

namespace App\UI\Controller;

use App\Application\Query\Blog\PostQueryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function homepage(PostQueryService $postQueryService): Response
    {
        $recentPosts = $postQueryService->getRecentPosts(6);
        return $this->render('pages/homepage.html.twig', [
            'posts' => $recentPosts,
        ]);
    }

}
