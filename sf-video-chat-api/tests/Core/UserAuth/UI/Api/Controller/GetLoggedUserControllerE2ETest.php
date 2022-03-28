<?php

declare(strict_types=1);

namespace App\Tests\Core\UserAuth\UI\Api\Controller;

use App\Core\UserAuth\Domain\Model\User;
use App\Core\UserAuth\Domain\Model\UserId;
use App\Core\UserAuth\Infrastructure\Auth\Auth;
use App\Core\UserAuth\Infrastructure\Repository\DQL\UserRepository;
use App\Tests\DatabasePrimer;
use App\Tests\TestSupport\UserAuth\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Uid\Uuid;

/**
 * @group E2ETest
 */
class GetLoggedUserControllerE2ETest extends WebTestCase
{
    private KernelBrowser|null $client;
    private UserRepository|null $userRepository;
    private EntityManagerInterface|null $entityManager;
    
    protected function setUp(): void
    {
        self::ensureKernelShutdown();
        $this->client = static::createClient();
        DatabasePrimer::prime($this->client->getKernel());
        $this->userRepository = $this->client->getKernel()->getContainer()->get(UserRepository::class);
        $this->entityManager = $this->client->getKernel()->getContainer()->get('doctrine.orm.entity_manager');
    }

    private function addUserToDatabase(User $user): void
    {
        $this->userRepository->addUser($user);
        $this->entityManager->flush();
    }

    public function test_it_can_get_logged_user(): void
    {
        $user = UserService::getUserInstance();
        $this->addUserToDatabase($user);

        $this->client->loginUser(new Auth(
            id: $user->getIdAsString(),
            email: $user->getEmail(),
            username: $user->getUsername(),
            password: 'pass1234',
            roles: ['ROLE_USER']
        ));

        $content = json_encode([
            'id' => $user->getIdAsString()
        ]);

        $this->client->xmlHttpRequest(
            method: 'GET',
            uri: '/api/user/get-logged-user',
            parameters: [],
            files: [],
            server: [],
            content: $content
        );

        $response = $this->client->getResponse();

        $this->assertResponseIsSuccessful();
        $this->assertEquals($response->getContent(), json_encode([
            'user' => [
                'id' => $user->getIdAsString(),
                'email' => $user->getEmail(),
                'username' => $user->getUsername(),
                'roles' => ['ROLE_USER']
            ]
        ]));
    }

    protected function tearDown(): void
    {
        self::ensureKernelShutdown();
        $this->client = null;
        $this->userRepository = null;
        $this->entityManager = null;
    }
}