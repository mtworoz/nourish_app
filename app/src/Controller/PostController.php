<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use App\Form\WriteCommentFormType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/post/{id}', name: 'single_post')]
    public function showPost(Post $post, Request $request, EntityManagerInterface $em): Response
    {
        $commentForm = $this->createForm(WriteCommentFormType::class);
        $commentForm->handleRequest($request);
        if($commentForm->isSubmitted() && $commentForm->isValid()){
            /** @var Comment $comment */
            $comment = $commentForm->getData();
            $comment->setPost($post);
            $comment->setDate(new \DateTime);
            $em->persist($comment);
            $em->flush();
        }
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
