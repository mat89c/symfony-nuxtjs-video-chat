<?php

declare(strict_types=1);

namespace App\Core\Chat\UI\Api\Controller;

use App\Core\Chat\Application\GetChats\Query\GetChatsQuery;
use App\Shared\Infrastructure\Bus\Query\QueryBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Shared\Infrastructure\Auth\Auth;

#[Route('/api/chat/get-chat-channels', methods:['GET'])]
class GetChatsController extends AbstractController
{
    public function __construct(private QueryBusInterface $queryBus) {}
    
    public function __invoke(): JsonResponse
    {
        /**
         * @var Auth $user
         */
        $user = $this->getUser();
        
        $chatChannels = $this->queryBus->query(new GetChatsQuery($user->getId()));

        return $this->json($chatChannels);
    }
}