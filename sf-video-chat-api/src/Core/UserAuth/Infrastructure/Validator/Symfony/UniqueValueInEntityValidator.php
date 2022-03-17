<?php

declare(strict_types=1);

namespace App\Core\UserAuth\Infrastructure\Validator\Symfony;

use App\Core\UserAuth\Infrastructure\Repository\DQL\UserRepository;
use App\Core\UserAuth\Infrastructure\Validator\Symfony\UniqueValueInEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class UniqueValueInEntityValidator extends ConstraintValidator
{
    public function __construct(private EntityManagerInterface $entityManager, private UserRepository $userRepository) {}

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof UniqueValueInEntity) {
            throw new UnexpectedTypeException($constraint, UniqueValueInEntity::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if ($constraint->field === 'email') {
            if ($this->userRepository->findByEmail(email: $value)) {
                $this->context->buildViolation($constraint->message)
                    ->addViolation();
            }
        }
        
        if ($constraint->field  === 'username') {
            if ($this->userRepository->findByUsername(username: $value)) {
                $this->context->buildViolation($constraint->message)
                    ->addViolation();
            }
        }
    }
}