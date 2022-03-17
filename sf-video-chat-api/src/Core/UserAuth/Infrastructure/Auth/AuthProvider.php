<?php

declare(strict_types=1);

namespace App\Core\UserAuth\Infrastructure\Auth;

use App\Core\UserAuth\Domain\Model\UserRepositoryInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class AuthProvider implements UserProviderInterface
{
    public function __construct(private UserRepositoryInterface $userRepository) {}

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        return new Auth(
            email: 'email',
            password: 'pass1234',
            roles: ['ROLE_USER'] 
        );
    }


    public function refreshUser(UserInterface $user)
    {
        return $this->loadUserByIdentifier($user->getUserIdentifier());
    }

    public function supportsClass(string $class)
    {
        return Auth::class === $class;
    }
}