<?php

declare(strict_types=1);

namespace App\Core\UserAuth\Domain\Model;

class UserId
{   
    public function __construct(private string $uuid) {}

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function __toString(): string
    {
        return $this->uuid;
    }
}   