<?php

declare(strict_types=1);

namespace App\Core\UserAuth\Infrastructure\Validator\Symfony;

use App\Core\UserAuth\Domain\Model\UserId;
use App\Core\UserAuth\Infrastructure\Repository\DQL\UserRepository;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraint;

class ValueNotExistsInEntityValidator extends ConstraintValidator
{
    public function __construct(private UserRepository $userRepository) {}

    public function validate($value, Constraint $constraint)
    {
        if (null === $value || '' === $value) {
            return;
        }

        if ($constraint->field === 'id') {
            if ($this->userRepository->findById(id: new UserId($value))) {
                $this->context->buildViolation($constraint->message)
                    ->addViolation();
            }
        }
    }
}