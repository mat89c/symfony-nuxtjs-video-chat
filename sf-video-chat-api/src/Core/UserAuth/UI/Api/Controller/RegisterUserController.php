<?php

declare(strict_types=1);

namespace App\Core\UserAuth\UI\Api\Controller;

use App\Core\UserAuth\Application\RegisterUser\Command\RegisterUserCommand;
use App\Shared\Infrastructure\Bus\Command\CommandBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface; 

#[Route('/api/user/register', methods: ['POST'])]
class RegisterUserController extends AbstractController
{
    public function __construct(
        private SerializerInterface $serializer,
        private CommandBusInterface $commandBus
    ) {}
    
    public function __invoke(Request $request): JsonResponse
    {
        $userData = $this->serializer->deserialize($request->getContent(), RegisterUserCommand::class, 'json');

        $this->commandBus->dispatch(new RegisterUserCommand(
            email: $userData->getEmail(),
            username: $userData->getUsername(),
            password: $userData->getPassword()
        ));

        return $this->json(true);
    }
}