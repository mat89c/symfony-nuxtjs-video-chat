<?php

declare(strict_types=1);

namespace App\Core\Chat\Domain\Model\ChatMessage;

class ChatMessageAuthor 
{
    public function __construct(
        private ChatMessageAuthorId $id,
        private string $name
    ) {}
}