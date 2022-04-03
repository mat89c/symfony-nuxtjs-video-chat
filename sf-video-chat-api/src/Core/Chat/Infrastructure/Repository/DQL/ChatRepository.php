<?php

declare(strict_types=1);

namespace App\Core\Chat\Infrastructure\Repository\DQL;

use App\Core\Chat\Domain\Model\Chat;
use App\Core\Chat\Domain\Model\ChatMessage\ChatMessage;
use App\Core\Chat\Domain\Model\ChatRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Core\Chat\Domain\Model\ChatId;

class ChatRepository implements ChatRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $chatEntityManager
    ) {}

    public function addChatMessage(ChatMessage $chatMessage): void
    {
        $this->chatEntityManager->persist($chatMessage);
    }

    public function getChats(): array
    {
        return $this->chatEntityManager->createQueryBuilder()
            ->select('c.id', 'c.name')
            ->from(Chat::class, 'c')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findOneById(ChatId $chatId): ?array { 
        return $this->chatEntityManager->createQueryBuilder()
            ->select('c.id', 'c.name')
            ->from(Chat::class, 'c')
            ->where('c.id = :chatId')
            ->setParameter('chatId', $chatId, 'uuid')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findChatMessagesById(ChatId $chatId, int $page): ?array { 
        $itemsPerPage = 10;

        return $this->chatEntityManager->createQueryBuilder()
            ->select('c.id', 'c.content', 'c.author.name as authorName', 'c.createdAt')
            ->from(ChatMessage::class, 'c')
            ->where('c.chatId = :chatId')
            ->setParameter('chatId', $chatId, 'uuid')
            ->orderBy('c.createdAt', 'DESC')
            ->setFirstResult($itemsPerPage * ($page - 1))
            ->setMaxResults($itemsPerPage) 
            ->getQuery()
            ->getResult()
        ;
    }
}