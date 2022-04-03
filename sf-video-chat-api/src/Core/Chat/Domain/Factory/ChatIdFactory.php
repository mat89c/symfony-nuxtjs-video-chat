<?php

declare(strict_types=1);

namespace App\Core\Chat\Domain\Factory;

use App\Core\Chat\Domain\Model\ChatId;
use App\Core\UserAuth\Domain\Model\UuidInterface;

class ChatIdFactory
{
    public function __construct(private UuidInterface $uuid) {}

    public function create(): ChatId
    {
        return new ChatId(uuid: $this->uuid->generate());
    }

    public function createFromString(string $uuid): ChatId
    {
        return new ChatId(uuid: $uuid);
    }
}