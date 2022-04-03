<?php

declare(strict_types=1);

namespace App\Core\Chat\Application\FetchChatMessagesById\QueryHandler;

use App\Core\Chat\Application\FetchChatMessagesById\Query\FetchChatMessagesByIdQuery;
use App\Core\Chat\Domain\Model\ChatId;
use App\Core\Chat\Domain\Model\ChatRepositoryInterface;
use App\Shared\Application\QueryHandler\QueryHandlerInterface;
use App\Shared\Application\Validation\ValidationInterface;

class FetchChatMessagesByIdHandler implements QueryHandlerInterface
{
    public function __construct(
        private ValidationInterface $validator,
        private ChatRepositoryInterface $chatRepository
    ) {
    }

    public function __invoke(FetchChatMessagesByIdQuery $fetchChatMessagesByIdQuery): ?array
    {
        $errors = $this->validator->validate($fetchChatMessagesByIdQuery);

        if (count($errors) > 0) {
            $this->exception->throw($errors[0]->getMessage(), 400);
        }

        $chatId = new ChatId($fetchChatMessagesByIdQuery->getChatId());
        $page = $fetchChatMessagesByIdQuery->getPage();

        $chatMessages = array_reverse($this->chatRepository->findChatMessagesById($chatId, $page));
        return $chatMessages;
    }
}
