<?php

declare(strict_types=1);

namespace App\Tests\Core\UserAuth\UI\Api\Controller;

use App\Tests\DatabasePrimer;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @group E2ETest
 */
class RegisterUserControllerE2ETest extends WebTestCase
{
    private KernelBrowser|null $client;

    protected function setUp(): void
    {
        self::ensureKernelShutdown();
        $this->client = static::createClient();
        DatabasePrimer::prime($this->client->getKernel());
    }

    public function test_it_can_register_user(): void
    {
        $content = json_encode([
            'email' => 'user@example.pl',
            'username' => 'mat89c',
            'password' => 'pass1234'
        ]);

        $this->client->xmlHttpRequest(
            method: 'POST',
            uri: '/api/user/register',
            parameters: [],
            files: [],
            server: [],
            content: $content
        );

        $this->assertResponseIsSuccessful();
    }

    protected function tearDown(): void
    {
        self::ensureKernelShutdown();
        $this->client = null;
    }
}