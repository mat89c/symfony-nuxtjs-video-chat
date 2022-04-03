<?php

declare(strict_types=1);

namespace App\Core\Chat\Domain\Model\ChatParticipant;

use App\Core\Chat\Domain\Model\ChatId;

class ChatParticipant
{
    public function __construct(
        private ChatParticipantId $id,
        private ChatId $chadId
    ) {}
}