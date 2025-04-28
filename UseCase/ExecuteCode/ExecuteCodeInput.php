<?php

declare(strict_types=1);

namespace App\UseCase\ExecuteCode;

final readonly class ExecuteCodeInput
{
    public function __construct(
        public string $code,
        public array $args
    ) {
    }

}