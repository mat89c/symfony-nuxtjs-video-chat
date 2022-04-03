<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Core\Chat\Domain\Factory\ChatIdFactory;
use App\Core\Chat\Domain\Model\Chat;
use App\Core\Chat\Domain\Model\ChatType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ManagerRegistry;
use App\Core\UserAuth\Domain\Model\UuidInterface;

class ChatFixtures extends Fixture
{
    public function __construct(
        private ManagerRegistry $doctrine,
        private UuidInterface $uuid
    ) {}

    public function load(ObjectManager $objectManager): void
    {
        $chatEntityManager = $this->doctrine->getManager('chat');

        $chatIdFactory = new ChatIdFactory(uuid: $this->uuid);
        $chatId = $chatIdFactory->create();

        $chat = new Chat(
            id: $chatId,
            name: 'MAIN',
            chatType: ChatType::MAIN->value
        );

        $chatEntityManager->persist($chat);
        $chatEntityManager->flush();
    }
}