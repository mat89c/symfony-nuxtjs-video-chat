<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Query;

use App\Shared\Application\Query\QueryInterface;

interface QueryBusInterface
{
    public function query(QueryInterface $query): mixed;
}

