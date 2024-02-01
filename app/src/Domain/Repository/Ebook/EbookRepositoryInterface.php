<?php

namespace App\Domain\Repository\Ebook;

use App\Domain\Entity\Ebook\Ebook;

interface EbookRepositoryInterface
{
    public function find($id, $lockMode = null, $lockVersion = null);

    public function findOneBy(array $criteria, array $orderBy = null);

    public function findAll();

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);

    public function save(Ebook $ebook);

    public function remove(Ebook $ebook);
}
