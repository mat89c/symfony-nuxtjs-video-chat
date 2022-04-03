<?php

declare(strict_types=1);

namespace App\Shared\Application\Validation;

use App\Shared\Application\Command\CommandInterface;
use App\Shared\Application\Query\QueryInterface;

interface ValidationInterface
{
    public function validate(CommandInterface|QueryInterface $object): array;
}