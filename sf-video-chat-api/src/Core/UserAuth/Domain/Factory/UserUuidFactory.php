<?php

declare(strict_types=1);

namespace App\Core\UserAuth\Domain\Factory;

use App\Core\UserAuth\Domain\Model\UserId;
use App\Core\UserAuth\Domain\Model\UuidInterface;

class UserUuidFactory
{
    public function __construct(private UuidInterface $uuid) {}

    public function create(): UserId
    {
        return new UserId($this->uuid->generate());
    }
}