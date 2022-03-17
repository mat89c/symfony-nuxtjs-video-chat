<?php

declare(strict_types=1);

namespace App\Core\UserAuth\Infrastructure\Repository\DQL;

use App\Core\UserAuth\Domain\Model\User;
use App\Core\UserAuth\Domain\Model\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function addUser(User $user): void
    {
        $this->entityManager->persist($user);
    }

    public function findById(string $uuid): ?array
    {
        return $this->entityManager->createQueryBuilder()
            ->select('u.id')
            ->from(User::class, 'u')
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findByEmail(string $email): ?array
    {
        return $this->entityManager->createQueryBuilder()
            ->select('u.id', 'u.email', 'u.username', 'u.roles')
            ->from(User::class, 'u')
            ->where('u.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findByUsername(string $username): ?array
    {
        return $this->entityManager->createQueryBuilder()
            ->select('u.id', 'u.email', 'u.username', 'u.roles')
            ->from(User::class, 'u')
            ->where('u.username = :username')
            ->setParameter('username', $username)
            ->getQuery()
            ->getOneOrNullResult();
    }
}