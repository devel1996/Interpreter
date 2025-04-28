<?php

declare(strict_types=1);

namespace App\Infrastructure\Core;

use App\Domain\Service\LexicalAnalyserService;
use App\Domain\Service\Parser;
use App\UI\Cli\ExecuteFileCommand;
use App\UseCase\ExecuteCode\ExecuteCodeUseCase;

abstract class ServiceProvider
{
    public static function bindServices(): void
    {
        // interpreter bindings
        Container::getInstance()->bind(Context::class, fn() => new Context(new FunctionRegistry()));
        Container::getInstance()->bind(Interpreter::class, fn() => new Interpreter(Container::getInstance()->make(Context::class)));

        // use case bindings
        Container::getInstance()->bind(
            abstract: ExecuteCodeUseCase::class,
            factory: fn() => new ExecuteCodeUseCase(
                new LexicalAnalyserService(),
                new Parser(),
                Container::getInstance()->make(Interpreter::class)
            )
        );

        // ui bindings
        Container::getInstance()->bind(ExecuteFileCommand::class, fn() => new ExecuteFileCommand(
            Container::getInstance()->make(ExecuteCodeUseCase::class),
        ));
    }
}