<?php

declare(strict_types=1);

namespace App\Tests\Core\UserAuth\Domain\Model;

use App\Core\UserAuth\Domain\Model\UserId;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

/**
 * @group UnitTest
 */
class UserIdUnitTest extends TestCase
{
    private UserId|null $userId;

    private string $uuid;

    protected function setUp(): void
    {
        $this->uuid = Uuid::v4()->toBinary();
        $this->userId = new UserId(
            uuid: $this->uuid
        );
    }

    public function test_it_can_be_converted_to_string()
    {
        $this->assertEquals($this->uuid, (string)$this->userId);
    }

    protected function tearDown(): void
    {
        $this->userId = null;
    }
}