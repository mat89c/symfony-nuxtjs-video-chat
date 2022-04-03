<?php

declare(strict_types=1);

namespace App\Core\Chat\Application\FetchChatMessagesById\Query;

use App\Shared\Application\Query\QueryInterface;

class FetchChatMessagesByIdQuery implements QueryInterface
{
    public function __construct(
        private string $chatId,
        private int $page
    ) {}

    public function getChatId(): string
    {
        return $this->chatId;
    }

    public function getPage(): int 
    {
        return $this->page;
    }
}