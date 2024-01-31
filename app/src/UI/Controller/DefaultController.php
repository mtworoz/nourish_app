<?php

namespace App\UI\Controller;

use App\Domain\Repository\Blog\PostRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function homepage(PostRepositoryInterface $postRepository): Response
    {
        $recentPosts = $postRepository->getRecentPosts(6);
        return $this->render('pages/homepage.html.twig', [
            'posts' => $recentPosts,
        ]);
    }

}
