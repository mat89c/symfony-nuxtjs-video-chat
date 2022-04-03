<?php

declare(strict_types=1);

namespace App\Core\Chat\Domain\Factory;

use App\Core\Chat\Domain\Model\ChatMessage\ChatMessageId;
use App\Core\UserAuth\Domain\Model\UuidInterface;

class ChatMessageIdFactory
{
    public function __construct(private UuidInterface $uuid) {}

    public function create(): ChatMessageId
    {
        return new ChatMessageId(uuid: $this->uuid->generate());
    }

    public function createFromString(string $uuid): ChatMessageId
    {
        return new ChatMessageId(uuid: $uuid);
    }
}