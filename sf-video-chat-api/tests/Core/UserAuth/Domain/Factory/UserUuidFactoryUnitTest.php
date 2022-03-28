<?php

declare(strict_types=1);

namespace App\Tests\Core\UserAuth\Domain\Factory;

use App\Core\UserAuth\Domain\Factory\UserUuidFactory;
use App\Core\UserAuth\Domain\Model\UserId;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Uid\Uuid;

/**
 * @group UnitTest
 */
class UserUuidFactoryUnitTest extends KernelTestCase
{
   private UserUuidFactory|null $userUuidFactory;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->userUuidFactory = $kernel->getContainer()->get(UserUuidFactory::class);
    }

    public function test_it_can_create_user_id(): void
    {
        $userId = $this->userUuidFactory->create();

        $this->assertInstanceOf(UserId::class, $userId);
    }

    public function test_it_can_create_user_id_from_string(): void
    {
        $uuid = Uuid::v4()->toRfc4122();
        
        $userId = $this->userUuidFactory->createFromString($uuid);
        $this->assertInstanceOf(UserId::class, $userId);
    }

    protected function tearDown(): void
    {
        $this->userUuidFactory = null;

        if (self::$kernel !== null) {
            self::$kernel->shutdown();
        }
    }
}