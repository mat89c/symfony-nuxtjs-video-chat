<?php

declare(strict_types=1);

namespace App\Tests\Core\UserAuth\Domain\Model;

use App\Core\UserAuth\Domain\Model\UserId;
use App\Core\UserAuth\Domain\Model\UserRepositoryInterface;
use App\Core\UserAuth\Infrastructure\Repository\DQL\UserRepository;
use App\Tests\DatabasePrimer;
use App\Tests\TestSupport\UserAuth\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Uid\Uuid;

class UserRepositoryIntegrationTest extends KernelTestCase
{
    private UserRepositoryInterface|null $userRepository;
    private EntityManagerInterface|null $entityManager;
    
    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        DatabasePrimer::prime(kernel: $kernel);

        $this->userRepository = $kernel->getContainer()->get(UserRepository::class);
        $this->entityManager = $kernel->getContainer()->get('doctrine.orm.entity_manager');
    }

    public function test_it_can_find_user_by_email(): void
    {
        $user = UserService::getUserInstance();
        $this->userRepository->addUser($user);
        $this->entityManager->flush();

        $userData = $this->userRepository->findByEmail(email: $user->getEmail());
        
        $this->assertEquals($user->getEmail(), $userData['email']);
    }
    
    public function test_it_can_find_user_by_username(): void
    {
        $user = UserService::getUserInstance();
        $this->userRepository->addUser($user);
        $this->entityManager->flush();

        $userData = $this->userRepository->findByUsername(username: $user->getUsername());

        $this->assertEquals($user->getUsername(), $userData['username']);
    }

    public function test_it_can_find_user_by_id(): void
    {
        $user = UserService::getUserInstance();
        $this->userRepository->addUser($user);
        $this->entityManager->flush();

        $userData = $this->userRepository->findById(id: $user->getId());

        $this->assertEquals($user->getUsername(), $userData['username']);
    }

    protected function tearDown(): void
    {
        $this->userRepository = null;
        $this->entityManager = null;
        
        if (self::$kernel !== null) {
            self::$kernel->shutdown();
        }
    }
}