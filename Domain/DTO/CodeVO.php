<?php

declare(strict_types=1);

namespace App\Domain\DTO;

final readonly class CodeVO
{
    public function __construct(
        public object $code,
        public array $args,
    ) {
    }


}