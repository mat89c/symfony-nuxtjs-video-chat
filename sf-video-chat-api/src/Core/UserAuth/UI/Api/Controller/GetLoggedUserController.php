<?php

declare(strict_types=1);

namespace App\Core\UserAuth\UI\Api\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Core\UserAuth\Infrastructure\Auth\Auth;

#[Route('/api/user/get-logged-user', methods: ['GET'])]
class GetLoggedUserController extends AbstractController
{
    public function __invoke(): JsonResponse
    {
        /**
         * @var Auth
         */
        $user = $this->getUser();

        return $this->json([
            'user' => [
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'username' => $user->getUsername(),
                'roles' => $user->getRoles()
            ]
        ]);
    }
}