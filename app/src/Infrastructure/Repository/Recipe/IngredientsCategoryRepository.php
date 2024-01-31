<?php

namespace App\Infrastructure\Repository\Recipe;

use App\Domain\Entity\Recipe\IngredientsCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<IngredientsCategory>
 *
 * @method IngredientsCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method IngredientsCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method IngredientsCategory[]    findAll()
 * @method IngredientsCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IngredientsCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IngredientsCategory::class);
    }
}
