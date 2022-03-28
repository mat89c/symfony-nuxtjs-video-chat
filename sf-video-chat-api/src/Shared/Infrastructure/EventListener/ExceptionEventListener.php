<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\EventListener;

use App\Shared\Infrastructure\Exception\ApiException;
use App\Shared\Infrastructure\Exception\Application\ApplicationLayerException;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Messenger\Exception\HandlerFailedException;

class ExceptionEventListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if ($exception instanceof ApiException || $exception instanceof HandlerFailedException || $exception instanceof AccessDeniedHttpException) {

            if ($exception->getCode() === 0) {
                return;
            }

            if ($exception instanceof ApiException) {
                $response = new JsonResponse([
                    'message' => $exception->getMessage()
                ], $exception->getCode());

                $event->setResponse($response);
            }

            $previous = $exception->getPrevious();

            if ($previous instanceof ApplicationLayerException) {
                $response = new JsonResponse([
                    'message' => $previous->getMessage()
                ], $previous->getCode());
    
                $event->setResponse($response);
            }
        }
    }
}