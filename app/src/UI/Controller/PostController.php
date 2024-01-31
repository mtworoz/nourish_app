<?php

namespace App\UI\Controller;

use App\Application\Service\Blog\CommentService;
use App\Domain\Repository\Blog\PostRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use JetBrains\PhpStorm\NoReturn;

class PostController extends AbstractController
{
    public function __construct(
        private PostRepositoryInterface $postRepository,
        private CommentService $commentService
    )
    {
    }

    #[Route('/post/{id}', name: 'single_post')]
    public function showPost(int $id, Request $request): Response
    {
        $post = $this->postRepository->find($id);

        if (!$post) {
            throw $this->createNotFoundException('Post not found');
        }

        $commentFormOrSuccess = $this->commentService->processCommentForm($request, $post);

        if ($commentFormOrSuccess instanceof FormInterface){
            return $this->render('pages/post.html.twig', [
                'post' => $post,
                'commentForm' => $commentFormOrSuccess->createView(),
            ]);
        }

        return $this->redirectToRoute('single_post', ['id' => $post->getId()]);
    }

    #[NoReturn] #[Route('/posts', name: 'allPosts')]
    public function showAllPosts(){
        dd($this->postRepository->findAll());
    }

}
