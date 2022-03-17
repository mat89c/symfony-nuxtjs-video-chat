<?php

declare(strict_types=1);

namespace App\Tests\Core\UserAuth\Application\RegisterUser\CommandHandler;

use App\Core\UserAuth\Application\RegisterUser\CommandHandler\RegisterUserHandler;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Core\UserAuth\Application\RegisterUser\Command\RegisterUserCommand;

/**
 * UnitTest
 */
class RegisterUserHandlerUnitTest extends KernelTestCase
{
    private RegisterUserHandler|null $registerUserHandler;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->registerUserHandler = $kernel->getContainer()->get(RegisterUserHandler::class);
    }

    public function test_it_throw_exception_on_invalid_data(): void
    {
        $registerUserCommand = new RegisterUserCommand(
            email: 'wrong-email.pl',
            username: 'username',
            password: 'pass1234'
        );

        $commandHandler = $this->registerUserHandler;

        $this->expectException(\Exception::class);
        $commandHandler($registerUserCommand);
    }

    protected function tearDown(): void
    {
        $this->registerUserHandler = null;
    }
}