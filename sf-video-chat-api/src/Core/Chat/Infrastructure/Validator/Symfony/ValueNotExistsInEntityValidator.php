<?php

declare(strict_types=1);

namespace App\Core\Chat\Infrastructure\Validator\Symfony;

use App\Core\Chat\Domain\Model\ChatId;
use App\Core\Chat\Domain\Model\ChatRepositoryInterface;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraint;

class ValueNotExistsInEntityValidator extends ConstraintValidator
{
    public function __construct(private ChatRepositoryInterface $chatRepository) {}

    public function validate($value, Constraint $constraint)
    {
        if (null === $value || '' === $value) {
            return;
        }

        if ($constraint->field === 'chatId') {
            if (!$this->chatRepository->findOneById(new ChatId($value))) {
                $this->context->buildViolation($constraint->message)
                    ->addViolation();
            }
        }
    }
}