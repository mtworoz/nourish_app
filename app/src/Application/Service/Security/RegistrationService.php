<?php

namespace App\Application\Service\Security;

use App\Domain\Entity\User\User;
use App\Domain\Repository\User\UserRepositoryInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationService
{
    private UserRepositoryInterface $userRepository;
    private UserPasswordHasherInterface $userPasswordHasher;

    public function __construct(
        UserRepositoryInterface $userRepository,
        UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userRepository = $userRepository;
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function registerUser(User $user, string $plainPassword): void
    {
        $password = $this->userPasswordHasher->hashPassword(
            $user,
            $plainPassword
        );

        $user->setPassword($password);

        $this->userRepository->save($user);
    }
}

