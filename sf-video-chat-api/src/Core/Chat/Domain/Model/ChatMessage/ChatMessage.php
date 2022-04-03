<?php

declare(strict_types=1);

namespace App\Core\Chat\Domain\Model\ChatMessage;

use App\Core\Chat\Domain\Model\ChatId;
use DateTimeImmutable;

class ChatMessage
{
    public function __construct(
        private ChatMessageId $id,
        private ChatId $chatId,
        private string $content,
        private DateTimeImmutable $createdAt,
        private ChatMessageAuthor $author
    ) {}
}