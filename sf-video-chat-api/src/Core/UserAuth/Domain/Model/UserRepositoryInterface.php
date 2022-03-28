<?php

declare(strict_types=1);

namespace App\Core\UserAuth\Domain\Model;

interface UserRepositoryInterface
{
    public function addUser(User $user): void;

    public function findById(UserId $id): ?array;

    public function findByEmail(string $email): ?array;

    public function findByUsername(string $username): ?array;
}