<?php

namespace App\UI\Controller;

use App\Domain\Entity\Blog\Comment;
use App\Domain\Entity\Blog\Post;
use App\Infrastructure\Repository\Blog\PostRepository;
use App\UI\Form\WriteCommentFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function dd;

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
