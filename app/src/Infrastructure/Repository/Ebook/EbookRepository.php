<?php

namespace App\Infrastructure\Repository\Ebook;

use App\Domain\Entity\Ebook\Ebook;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ebook>
 *
 * @method Ebook|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ebook|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ebook[]    findAll()
 * @method Ebook[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EbookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ebook::class);
    }

}
