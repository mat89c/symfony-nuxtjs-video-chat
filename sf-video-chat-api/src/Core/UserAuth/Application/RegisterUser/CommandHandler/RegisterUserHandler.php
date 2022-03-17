<?php

declare(strict_types=1);

namespace App\Core\UserAuth\Application\RegisterUser\CommandHandler;

use App\Core\UserAuth\Application\RegisterUser\Command\RegisterUserCommand;
use App\Core\UserAuth\Domain\Factory\UserFactory;
use App\Core\UserAuth\Domain\Factory\UserUuidFactory;
use App\Core\UserAuth\Domain\Model\UserRepositoryInterface;
use App\Shared\Application\CommandHandler\CommandHandlerInterface;
use App\Shared\Application\Exception\ExceptionInterface;
use App\Shared\Application\Validation\ValidationInterface;

final class RegisterUserHandler implements CommandHandlerInterface
{
    public function __construct(
        private UserUuidFactory $userUuidFactory,
        private UserFactory $userFactory,
        private ValidationInterface $validator,
        private ExceptionInterface $exception,
        private UserRepositoryInterface $userRepository
    ) {}    

    public function __invoke(RegisterUserCommand $registerUserCommand): void
    {
        $errors = $this->validator->validate(command: $registerUserCommand);
        
        if (count($errors) > 0) {
            $this->exception->throw($errors[0]->getMessage(), 400);
        }

        $email = $registerUserCommand->getEmail();
        $username = $registerUserCommand->getUserName();
        $password = $registerUserCommand->getPassword();
        
        $id = $this->userUuidFactory->create();

        $user = $this->userFactory->create(
            id: $id,
            email: $email,
            username: $username,
            password: $password,
            roles: ['ROLE_USER']
        );

        $this->userRepository->addUser($user);
    }
}