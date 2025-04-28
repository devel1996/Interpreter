<?php

declare(strict_types=1);

namespace App\Infrastructure\Core;

use App\Domain\Exceptions\WrongArgumentException;

final class Kernel
{
    public function run(array $argv): void
    {
        // add bindings
        ServiceProvider::bindServices();

        // call command by arg
        $commandClass = Router::getCommand($argv[1] ?? null);

        if ($commandClass === null) {
            exit('Command not found');
        }

        /** @var CommandInterface $command */
        $command = Container::getInstance()->make($commandClass);

        $command->run($this->parseNamedArguments(array_slice($argv, 2)));

    }

    private function parseNamedArguments(array $argv): array
    {
        $arguments = [];

        foreach ($argv as $arg) {
            if (!str_starts_with($arg, '--')) {
                throw new WrongArgumentException();
            }
            $pair = explode('=', ltrim($arg, '--'));
            $arguments[$pair[0]] = $pair[1] ?? true;

        }
        return $arguments;
    }
}
