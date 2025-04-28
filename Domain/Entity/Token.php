<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Enum\TokenType;

final readonly class Token
{
    public function __construct(
        public TokenType $type,
        public string $value,
        public int $pos,
    ) {
    }
}
