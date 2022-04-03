<?php

declare(strict_types=1);

namespace App\Core\Chat\Application\AddMessage\CommandHandler;

use App\Core\Chat\Application\AddMessage\Command\AddMessageCommand;
use App\Core\Chat\Domain\Factory\ChatIdFactory;
use App\Core\Chat\Domain\Factory\ChatMessageAuthorIdFactory;
use App\Core\Chat\Domain\Factory\ChatMessageIdFactory;
use App\Core\Chat\Domain\Model\ChatMessage\ChatMessage;
use App\Core\Chat\Domain\Model\ChatMessage\ChatMessageAuthor;
use App\Core\Chat\Domain\Model\ChatRepositoryInterface;
use App\Core\UserAuth\Domain\Model\UuidInterface;
use App\Shared\Application\CommandHandler\CommandHandlerInterface;
use App\Shared\Application\Exception\ExceptionInterface;
use App\Shared\Application\Validation\ValidationInterface;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;

class AddMessageHandler implements CommandHandlerInterface
{
    public function __construct(
        private UuidInterface $uuid,
        private ChatRepositoryInterface $chatRepository,
        private EntityManagerInterface $chatEntityManager,
        private ValidationInterface $validator,
        private ExceptionInterface $exception
    ) {}

    public function __invoke(AddMessageCommand $addMessageCommand)
    {
        $errors = $this->validator->validate($addMessageCommand);

        if (count($errors) > 0) {
            $this->exception->throw($errors[0]->getMessage(), 400);
        }

        $chatMessageAuthorIdFactory = new ChatMessageAuthorIdFactory($this->uuid);
        $authorId = $chatMessageAuthorIdFactory->createFromString($addMessageCommand->getAuthorId());

        $author = new ChatMessageAuthor(
            id: $authorId,
            name: $addMessageCommand->getAuthorName()
        );
        
        $chatMessageIdFactory = new ChatMessageIdFactory($this->uuid);
        $chatMessageId = $chatMessageIdFactory->create();
        
        $chatIdFactory = new ChatIdFactory($this->uuid);
        $chatId = $chatIdFactory->createFromString($addMessageCommand->getChatId());        

        $chatMessage = new ChatMessage(
            id: $chatMessageId,
            chatId: $chatId,
            content: $addMessageCommand->getMessage(),
            createdAt: new DateTimeImmutable(),
            author: $author
        );

        $this->chatRepository->addChatMessage($chatMessage);
            
        $this->chatEntityManager->flush();
    }
}