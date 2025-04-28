<?php

declare(strict_types=1);

namespace App\Infrastructure\Core;

use App\Infrastructure\Functions\Interface\CallableFunctionInterface;

final class Context
{
    private array $argsVo;

    public function __construct(
        public FunctionRegistry $functions,
        public array $arguments = []
    ) {
        $this->argsVo = [];
    }

    public function getFunction(string $name): CallableFunctionInterface
    {
        return $this->functions->get($name);
    }

    public function setArgs($argsVo): void
    {
        $this->argsVo = $argsVo;
    }

    public function getArgs(): array
    {
        return $this->argsVo;
    }
}
