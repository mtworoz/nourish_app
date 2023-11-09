<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function homepage(CategoryRepository $categoryRepository, PostRepository $postRepository) : Response
    {
        $recentPosts = $postRepository->findBy([],['date' => 'DESC'],6);
        return $this->render('homepage.html.twig', [
            'categories' => $categoryRepository->findAll(),
            'posts' => $recentPosts
        ]);
    }

}
