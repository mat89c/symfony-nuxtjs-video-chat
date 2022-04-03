<?php

declare(strict_types=1);

namespace App\Core\Chat\Domain\Model\ChatMessage;

class ChatMessageId
{
    public function __construct(private string $uuid) {}

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function __toString()
    {
        return $this->uuid;
    }
}