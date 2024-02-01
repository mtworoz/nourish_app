<?php

namespace App\Infrastructure\Repository\Blog;

use App\Domain\Entity\Blog\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Domain\Repository\Blog\CommentRepositoryInterface;

/**
 * @extends ServiceEntityRepository<Comment>
 *
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository implements CommentRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    public function save(Comment $comment)
    {
        $this->_em->persist($comment);
        $this->_em->flush();
    }

    public function remove(Comment $comment)
    {
        $this->_em->remove($comment);
        $this->_em->flush();
    }

}
