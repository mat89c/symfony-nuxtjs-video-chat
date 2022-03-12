<?php

declare(strict_types=1);

namespace App\Core\UserAuth\UI\Api\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/register-user', methods: ['GET'])]
class RegisterUserController extends AbstractController
{
    public function __construct()
    {
        
    }
    
    public function __invoke(): JsonResponse
    {
        return $this->json(true);
    }
}