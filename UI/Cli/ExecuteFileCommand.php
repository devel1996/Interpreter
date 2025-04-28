<?php

declare(strict_types=1);

namespace App\UI\Cli;

use App\Domain\Exceptions\InvalidArgumentException;
use App\Domain\Exceptions\InvalidFileException;
use App\Domain\Exceptions\NoCodeException;
use App\Domain\Exceptions\UndefinedFileException;
use App\Infrastructure\Core\CommandInterface;
use App\UseCase\ExecuteCode\ExecuteCodeInput;
use App\UseCase\ExecuteCode\ExecuteCodeUseCase;

class ExecuteFileCommand implements CommandInterface
{
    public function __construct(
        private ExecuteCodeUseCase $useCase
    )
    {
    }

    public function run(array $arguments): void
    {
        $file = $arguments['file'] ?? '';
        $args = isset($arguments['args']) && is_string($arguments['args']) ? $arguments['args'] : '';

        if (!$code = $this->getFileContents($file)) {
            throw new NoCodeException();
        }

        if (isset($arguments['args']) && !$args) {
            throw new InvalidArgumentException();
        }

        ($this->useCase)(new ExecuteCodeInput($code, explode(',', $args)));
    }

    private function getFileContents(?string $file): string
    {
        if (!file_exists($file)) {
            throw new UndefinedFileException();
        }

        $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        if ($extension !== 'tphp') {
            throw new InvalidFileException();
        }

        return file_get_contents($file);
    }

}
