<?php

declare(strict_types=1);

namespace App\Infrastructure\Core;

use App\Domain\Exceptions\FunctionNotFoundException;
use App\Infrastructure\Functions\ArrayFunc;
use App\Infrastructure\Functions\ConcatFunc;
use App\Infrastructure\Functions\GetArgFunc;
use App\Infrastructure\Functions\Interface\CallableFunctionInterface;
use App\Infrastructure\Functions\JsonFunc;
use App\Infrastructure\Functions\MapFunc;

class FunctionRegistry
{
    public function __construct(
        private array $functions = []
    ) {
        $this->register('concat', new ConcatFunc());
        $this->register('array', new ArrayFunc());
        $this->register('getArg', new GetArgFunc());
        $this->register('map', new MapFunc());
        $this->register('json', new JsonFunc());
    }

    public function register(string $name, CallableFunctionInterface $fn): void
    {
        $this->functions[$name] = $fn;
    }

    public function get(string $name): CallableFunctionInterface
    {
        if (!isset($this->functions[$name])) {
            throw new FunctionNotFoundException($name);
        }

        return $this->functions[$name];
    }
}
