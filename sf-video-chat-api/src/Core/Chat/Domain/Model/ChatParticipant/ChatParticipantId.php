<?php

declare(strict_types=1);

namespace App\Core\Chat\Domain\Model\ChatParticipant;

class ChatParticipantId 
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