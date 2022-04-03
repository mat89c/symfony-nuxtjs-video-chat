<?php

declare(strict_types=1);

namespace App\Core\Chat\Infrastructure\Validator\Symfony;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class ValueNotExistsInEntity extends Constraint
{
    public string $message = '';
    public string $field = '';
}