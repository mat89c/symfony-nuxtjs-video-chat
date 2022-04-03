<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Auth;

use App\Core\UserAuth\Domain\Model\UserRepositoryInterface;
use App\Shared\Infrastructure\Exception\ApiException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class AuthProvider implements UserProviderInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private TranslatorInterface $translator
    ) {}

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $userData = $this->userRepository->findByEmail(email: $identifier);

        if(empty($userData)) {
            throw new ApiException($this->translator->trans('user.not_found'), 404);
        }

        return new Auth(
            id: $userData['id'],
            email: $userData['email'],
            username: $userData['username'],
            password: $userData['password'],
            roles: $userData['roles']
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