<?php

namespace App\Domain\Repository\User;

use App\Domain\Entity\User\User;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

interface UserRepositoryInterface
{
    public function find($id, $lockMode = null, $lockVersion = null);

    public function findOneBy(array $criteria, array $orderBy = null);

    public function findAll();

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);

    public function save(User $user);

    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword);

    public function createUser();
}

