<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Validator\Symfony;

use App\Shared\Application\Command\CommandInterface;
use App\Shared\Application\Query\QueryInterface;
use App\Shared\Application\Validation\ValidationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class Validator implements ValidationInterface
{
    public function __construct(private ValidatorInterface $validator) {}
    
    public function validate(CommandInterface|QueryInterface $object): array
    {
        $violations = $this->validator->validate($object);

        $errors = [];
        if (count($violations) > 0) {
            foreach ($violations as $violation) {
                $errors[] = $violation;
            }
        }

        return $errors;
    }
}   