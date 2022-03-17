<?php

declare(strict_types=1);

namespace App\Shared\Application\Validation;

use App\Shared\Application\Command\CommandInterface;

interface ValidationInterface
{
    public function validate(CommandInterface $command): array;
}