<?php

declare(strict_types=1);

namespace App\Core\Chat\Application\GetChats\Query;

use App\Shared\Application\Query\QueryInterface;

class GetChatsQuery implements QueryInterface
{
    public function __construct(private string $userId) {}

    public function getUserId(): string
    {
        return $this->userId;
    }
}