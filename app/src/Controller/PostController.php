<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/post/{id}', name: 'post')]
    public function showPost(Post $post){
        dd($post);
        return new Response('hello');
    }

    #[Route('/posts', name: 'allPosts')]
    public function showAllPosts(PostRepository $postRepository){
        dd($postRepository->findAll());
    }

}