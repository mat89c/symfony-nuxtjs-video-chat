<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Core\UserAuth\Domain\Factory\UserUuidFactory;
use App\Core\UserAuth\Domain\Model\User;
use App\Core\UserAuth\Domain\Model\UuidInterface;

class UserAuthFixtures extends Fixture
{
    public function __construct(
        private UuidInterface $uuid
    ) {}

    public function load(ObjectManager $manager): void
    {
        $userUuidFactory = new UserUuidFactory(uuid: $this->uuid);
        $userId = $userUuidFactory->create();

        $user = new User(
            id: $userId,
            email: 'user1@example.com',
            username: 'user1',
            roles: ['ROLE_USER'],
            password: 'pass1234'
        );

        $manager->persist($user);
        $manager->flush();
    }
}
