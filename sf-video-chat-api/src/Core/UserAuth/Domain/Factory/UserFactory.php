<?php

declare(strict_types=1);

namespace App\Core\UserAuth\Domain\Factory;

use App\Core\UserAuth\Domain\Model\User;
use App\Core\UserAuth\Domain\Model\UserId;

class UserFactory
{
    public function create(UserId $id, string $email, string $username, string $password, array $roles): User
    {
        return new User(
            id: $id,
            email: $email,
            username: $username,
            roles: $roles,
            password: $password
        );
    }
}