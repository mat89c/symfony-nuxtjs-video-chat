<?php

declare(strict_types=1);

namespace App\Core\UserAuth\Domain\Model;

interface UuidInterface
{
    public static function generate(): string;
}