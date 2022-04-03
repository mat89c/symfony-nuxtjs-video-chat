<?php

declare(strict_types=1);

namespace App\Core\Chat\UI\Api\Controller;

use App\Core\Chat\Application\AddMessage\Command\AddMessageCommand;
use App\Shared\Infrastructure\Bus\Command\CommandBusInterface;
use App\Shared\Infrastructure\Exception\ApiException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use App\Shared\Infrastructure\Auth\Auth;

#[Route('/api/chat/add-message', methods: ['POST'])]
class AddMessageController extends AbstractController
{
    public function __construct(
        private SerializerInterface $serializer,
        private CommandBusInterface $commandBus,
        private TranslatorInterface $translator
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent());

        /**
         * @var Auth $user
         */
        $user = $this->getUser();

        $this->commandBus->dispatch(new AddMessageCommand(
            chatId: $data->chatId,
            authorId: $user->getId(),
            authorName: $user->getUsername(),
            message: $data->message
        ));

        return $this->json(true);
    }
}