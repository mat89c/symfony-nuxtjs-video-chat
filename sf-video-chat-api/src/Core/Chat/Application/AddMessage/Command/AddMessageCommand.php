<?php

declare(strict_types=1);

namespace App\Core\Chat\Application\AddMessage\Command;

use App\Shared\Application\Command\CommandInterface;

class AddMessageCommand implements CommandInterface
{
    public function __construct(
        private string $chatId,
        private string $authorId,
        private string $authorName,
        private string $message
    ) {}

    public function getChatId(): string
    {
        return $this->chatId;
    }

    public function getAuthorId(): string
    {
        return $this->authorId;
    }

    public function getAuthorName(): string
    {
        return $this->authorName;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}