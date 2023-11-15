<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\WriteCommentFormType;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/post/{id}', name: 'single_post')]
    public function showPost(Post $post): Response
    {
        $commentForm = $this->createForm(WriteCommentFormType::class);
        return $this->render('pages/post.html.twig', [
            'post' => $post,
            'commentForm' => $commentForm
        ]);
    }

    #[Route('/posts', name: 'allPosts')]
    public function showAllPosts(PostRepository $postRepository){
        dd($postRepository->findAll());
    }

}
