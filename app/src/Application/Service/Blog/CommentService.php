<?php

namespace App\Application\Service\Blog;

use App\Domain\Entity\Blog\Post;
use App\UI\Form\WriteCommentFormType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class CommentService
{
    private FormFactoryInterface $formFactory;
    private EntityManagerInterface $entityManager;

    public function __construct(FormFactoryInterface $formFactory, EntityManagerInterface $entityManager)
    {
        $this->formFactory = $formFactory;
        $this->entityManager = $entityManager;
    }

    public function processCommentForm(Request $request, Post $post): ?FormInterface
    {
        $commentForm = $this->formFactory->create(WriteCommentFormType::class);
        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $comment = $commentForm->getData();
            $comment->setPost($post);
            $comment->setDate(new \DateTime);

            $this->entityManager->persist($comment);
            $this->entityManager->flush();

            return null;
        }

        return $commentForm;
    }
}
