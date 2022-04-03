<?php

declare(strict_types=1);

namespace App\Core\Chat\UI\Api\Controller;

use App\Core\Chat\Application\FetchChatMessagesById\Query\FetchChatMessagesByIdQuery;
use App\Shared\Infrastructure\Bus\Query\QueryBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/chat/fetch-chat-messages-by-id', methods: ['GET'])]
class FetchChatMessagesByIdController extends AbstractController 
{
    public function __construct(private QueryBusInterface $querBus) {}

    public function __invoke(Request $request): JsonResponse
    {
        $id = $request->query->get('id');
        $page = $request->query->get('page');
        
        $chatMessages = $this->querBus->query(new FetchChatMessagesByIdQuery($id, (int)$page));
        
        return $this->json($chatMessages);
    }
}