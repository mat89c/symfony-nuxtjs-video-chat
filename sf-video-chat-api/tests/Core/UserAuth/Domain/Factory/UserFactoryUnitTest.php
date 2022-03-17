<?php

declare(strict_types=1);

namespace App\Tests\Core\UserAuth\Domain\Factory;

use App\Core\UserAuth\Domain\Factory\UserFactory;
use App\Core\UserAuth\Domain\Model\User;
use App\Core\UserAuth\Domain\Model\UserId;
use PHPUnit\Framework\TestCase;

/**
 * @group UnitTest
 */
class UserFactoryUnitTest extends TestCase
{
    private UserFactory|null $userFactory;

    protected function setUp(): void
    {
        $this->userFactory = new UserFactory();
    }

    public function test_it_can_create_user(): void
    {
        $user = $this->userFactory->create(
            id: new UserId('123'),
            email: 'user@example.con',
            username: 'username',
            password: 'pass1234',
            roles: ['ROLE_USER']
        );

        $this->assertInstanceOf(User::class, $user);
    }

    protected function tearDown(): void
    {
        $this->userFactory = null;
    }
}