<?php

namespace App\Infrastructure\Repository\Blog;

use App\Domain\Entity\Blog\Post;
use App\Domain\Repository\Blog\PostRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Post>
 *
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository implements PostRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function save(Post $post)
    {
        $this->_em->persist($post);
        $this->_em->flush();
    }

    public function remove(Post $post)
    {
        $this->_em->remove($post);
        $this->_em->flush();
    }

    public function getRecentPosts(int $limit): array
    {
        return $this->findBy([], ['date' => 'DESC'], $limit);
    }
}