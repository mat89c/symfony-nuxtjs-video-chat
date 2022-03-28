<?php

declare(strict_types=1);

namespace App\Tests\TestSupport\UserAuth;

use App\Core\UserAuth\Domain\Model\User;
use App\Core\UserAuth\Domain\Model\UserId;
use Symfony\Component\Uid\Uuid;

class UserService
{
    public static function getUserInstance(
        UserId $id = null, 
        string $email = null, 
        string $username = null,
        array $roles = null,
        string $password = null): User
    {
        return new User(
            id: $id ?? new UserId(Uuid::v4()->toRfc4122()),
            email: $email ?? 'user@example.com',
            username: $username ?? 'username',
            roles: $roles ?? ['ROLE_USER'],
            password: $password ?? 'pass1234'
        );
    }
}