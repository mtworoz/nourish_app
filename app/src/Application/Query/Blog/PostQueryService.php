<?php

namespace App\Application\Query\Blog;

use App\Domain\Repository\Blog\PostRepositoryInterface;

class PostQueryService
{
    public function __construct(private PostRepositoryInterface $postRepository)
    {
    }

    public function getRecentPosts(int $limit): array
    {
        return $this->postRepository->findBy([], ['date' => 'DESC'], $limit);
    }

}
