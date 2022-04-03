<?php

declare(strict_types=1);

namespace App\Core\Chat\Domain\Factory;

use App\Core\Chat\Domain\Model\ChatMessage\ChatMessageAuthorId;
use App\Core\UserAuth\Domain\Model\UuidInterface;

class ChatMessageAuthorIdFactory
{
    public function __construct(private UuidInterface $uuid) {}

    public function create(): ChatMessageAuthorId
    {
        return new ChatMessageAuthorId(uuid: $this->uuid->generate());
    }

    public function createFromString(string $uuid): ChatMessageAuthorId
    {
        return new ChatMessageAuthorId(uuid: $uuid);
    }
}