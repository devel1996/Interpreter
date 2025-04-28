<?php

declare(strict_types=1);

namespace App\Infrastructure\Core;

use App\UI\Cli\ExecuteFileCommand;

abstract class Router
{
    public static function getCommands(): array
    {
        return [
            'execute' => ExecuteFileCommand::class,
        ];
    }

    public static function getCommand(?string $commandClass): ?string
    {
        return self::getCommands()[$commandClass] ?? null;
    }
}