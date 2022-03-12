<?php

declare(strict_types=1);

namespace App\Core\UserAuth\Infrastructure\UUID;

use App\Core\UserAuth\Domain\Model\UuidInterface;
use Symfony\Component\Uid\Uuid;

class Uid implements UuidInterface
{
    public static function generate(): string
    {
        return (string)Uuid::v4();
    }
}