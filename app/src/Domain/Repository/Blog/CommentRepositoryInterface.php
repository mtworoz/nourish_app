<?php

namespace App\Domain\Repository\Blog;

use App\Domain\Entity\Blog\Comment;

interface CommentRepositoryInterface
{
    public function find($id, $lockMode = null, $lockVersion = null);

    public function findOneBy(array $criteria, array $orderBy = null);

    public function findAll();

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);

    public function save(Comment $comment);

    public function remove(Comment $comment);
}
