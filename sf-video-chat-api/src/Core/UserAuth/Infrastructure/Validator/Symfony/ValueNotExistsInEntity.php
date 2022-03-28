<?php

declare(strict_types=1);

namespace App\Core\UserAuth\Infrastructure\Validator\Symfony;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class ValueNotExistsInEntity extends Constraint
{
    public string $message = '';
    public string $field = '';
}