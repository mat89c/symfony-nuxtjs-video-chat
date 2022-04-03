<?php

declare(strict_types=1);

namespace App\Core\Chat\Domain\Model;

use App\Core\Chat\Domain\Model\ChatParticipant\ChatParticipant;
use App\Core\Chat\Domain\Model\ChatMessage\ChatMessage;

enum ChatType: string
{
    case OPENED = 'OPENED';
    case CLOSED = 'CLOSED';
    case F2F = 'F2F';
    case MAIN = 'MAIN';  
}

class Chat
{
    /**
     * @var ChatParticipant[] $chatParticipatns
     */
    private array $chatParticipatns = [];

    /**
     * @var ChatMessage[] $chatMessages
     */
    private array $chatMessages = [];

    public function __construct(
        private ChatId $id,
        private string $name,
        private string $chatType,
    ) {}
}