<?php

declare(strict_types=1);

namespace App\Tests\Core\UserAuth\Domain\Model;

use App\Core\UserAuth\Domain\Model\User;
use App\Core\UserAuth\Domain\Model\UserId;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;
use App\Tests\TestSupport\UserAuth\UserService;

/**
 * @group UnitTest
 */
class UserUnitTest extends TestCase
{
    private User|null $user;

    protected function setUp(): void
    {
        $this->user = UserService::getUserInstance();
    }

    public function test_instance(): void
    {
        $this->assertInstanceOf(User::class, $this->user);
    }

    public function test_getters(): void
    {
        $uuid = Uuid::v4()->toRfc4122();
        $email = 'usertest@example.com';
        $username = 'usernametest'; 
        $user = UserService::getUserInstance(
            id: new UserId($uuid),
            email: $email,
            username: $username
        );
        
        $this->assertInstanceOf(UserId::class, $user->getId());
        $this->assertEquals($user->getIdAsString(), $uuid);
        $this->assertEquals($user->getEmail(), $email);
        $this->assertEquals($user->getUsername(), $username);
    }

    protected function tearDown(): void
    {
        $this->user = null;
    }
}