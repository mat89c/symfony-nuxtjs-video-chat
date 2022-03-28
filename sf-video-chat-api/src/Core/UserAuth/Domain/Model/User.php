<?php

declare(strict_types=1);

namespace App\Core\UserAuth\Domain\Model;

class User
{
    public function __construct(
        private UserId $id,
        private string $email,
        private string $username,
        private array $roles,
        private string $password
    )
    {
        $this->id = $id;
        $this->email = $email;
        $this->username = $username;
        $this->roles = $roles;
        $this->password = password_hash($password, PASSWORD_ARGON2I);
    }

    public function getId(): UserId
    {
        return $this->id;
    }

    public function getIdAsString(): string
    {
        return $this->id->getUuid();
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getUsername(): string
    {
        return $this->username;
    }
}