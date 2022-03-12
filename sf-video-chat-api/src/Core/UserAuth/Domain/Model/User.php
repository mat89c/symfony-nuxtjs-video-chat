<?php

declare(strict_types=1);

namespace App\Core\UserAuth\Domain\Model;

class User
{
    private UserId $id;

    private string $email;

    private string $username;

    private array $roles = [];

    private string $password;

    public function __construct(UserId $id)
    {
        $this->id = $id;
    }
}