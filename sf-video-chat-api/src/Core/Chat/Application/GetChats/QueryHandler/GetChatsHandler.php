<?php

declare(strict_types=1);

namespace App\Core\Chat\Application\GetChats\QueryHandler;

use App\Core\Chat\Application\GetChats\Query\GetChatsQuery;
use App\Core\Chat\Domain\Model\ChatRepositoryInterface;
use App\Shared\Application\QueryHandler\QueryHandlerInterface;

class GetChatsHandler implements QueryHandlerInterface
{
    public function __construct(
        private ChatRepositoryInterface  $chatRepository
    ) {}

    public function __invoke(GetChatsQuery $getChatsQuery)
    {
        return $this->chatRepository->getChats();
    }
}