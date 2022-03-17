<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Symfony\Component\Uid\Uuid;
use App\Core\UserAuth\Domain\Model\UserId;

class UuidType extends Type
{
    const UUID = 'uuid';

    public function getName(): string
    {
        return self::UUID;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        return (string)$value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): mixed
    {
        $uuid = Uuid::fromBinary($value);
        // return new UserId($uuid->toRfc4122());

        return $uuid->toRfc4122();
    }

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return $platform->getJsonTypeDeclarationSQL($fieldDeclaration);
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform) : bool
    {
        return true;
    }

}