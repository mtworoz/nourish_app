<?php

namespace App\Application\Service\Blog;

use App\Domain\Entity\Blog\Comment;
use App\Domain\Entity\Blog\Post;
use App\Domain\Repository\Blog\CommentRepositoryInterface;

class CommentService
{
    public function __construct(private CommentRepositoryInterface $commentRepository)
    {
    }

    public function processComment(Comment $comment, Post $post): void
    {
            $comment->setPost($post);
            $comment->setDate(new \DateTime);
            $this->commentRepository->save($comment);
    }
}
