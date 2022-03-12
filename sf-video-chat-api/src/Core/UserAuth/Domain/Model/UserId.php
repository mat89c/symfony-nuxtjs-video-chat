<?php

declare(strict_types=1);

namespace App\Core\UserAuth\Domain\Model;

class UserId
{   
    public function __construct(private string $uuid) {}

    public function uuid(): string
    {
        return $this->uuid;
    }
}