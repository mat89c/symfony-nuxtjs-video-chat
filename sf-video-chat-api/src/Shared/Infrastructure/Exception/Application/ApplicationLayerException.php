<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Exception\Application;

use App\Shared\Application\Exception\ExceptionInterface;

class ApplicationLayerException extends \Exception implements ExceptionInterface
{
    public function throw(string $message, int $code, \Exception $previous = null)
    {
        throw new self($message, $code, $previous);
    }
}