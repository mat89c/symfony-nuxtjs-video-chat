<?php

declare(strict_types=1);

namespace App\Core\UserAuth\UI\Api\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/home', methods: ['GET'])]
class HomeController extends AbstractController
{
    public function __invoke(): JsonResponse
    {
        return $this->json('ok');
    }
}