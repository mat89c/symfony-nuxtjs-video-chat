<?php

declare(strict_types=1);

namespace App\Shared\Application\Exception;

interface ExceptionInterface
{
    public function throw(string $message, int $code, \Exception $previous = null);
}