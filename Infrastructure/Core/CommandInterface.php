<?php

declare(strict_types=1);

namespace App\Infrastructure\Core;

use App\UseCase\ExecuteCode\ExecuteCodeUseCase;

interface CommandInterface
{
    public function run(array $arguments): void;
}