<?php

declare(strict_types=1);

namespace App\Core\Chat\Domain\Model;

use App\Core\Chat\Domain\Model\ChatMessage\ChatMessage;

interface ChatRepositoryInterface
{
    public function addChatMessage(ChatMessage $chatMessage): void;

    public function getChats(): array;

    public function findOneById(ChatId $chatId): ?array;  

    public function findChatMessagesById(ChatId $chatId, int $page): ?array;
}