<?php

namespace App\Application\FormHandling;


use App\Application\Service\Blog\CommentService;
use App\Domain\Entity\Blog\Post;
use App\UI\Form\WriteCommentFormType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class CommentFormHandler
{
    public function __construct(
        private FormFactoryInterface $formFactory,
        private CommentService $commentService
    )
    {
    }

    public function handleCommentForm(Request $request, Post $post): ?FormInterface
    {
        $commentForm = $this->formFactory->create(WriteCommentFormType::class);
        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $this->commentService->processComment($commentForm->getData(), $post);
            return null;
        }

        return $commentForm;
    }
}
