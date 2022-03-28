<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Uuid\SymfonyUuid;

use App\Core\UserAuth\Domain\Model\UuidInterface;
use Symfony\Component\Uid\Uuid;

class Uid implements UuidInterface
{
    public function generate(): string
    {
        return Uuid::v4()->toRfc4122();
    }
}