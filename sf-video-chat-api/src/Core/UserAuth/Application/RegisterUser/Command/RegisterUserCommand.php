<?php

declare(strict_types=1);

namespace App\Core\UserAuth\Application\RegisterUser\Command;

use App\Shared\Application\Command\CommandInterface;

class RegisterUserCommand implements CommandInterface
{
    public function __construct(
        private string $email,
        private string $username,
        private string $password
    ) {}

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getUserName(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}