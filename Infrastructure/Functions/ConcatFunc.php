<?php

declare(strict_types=1);

namespace App\Infrastructure\Functions;

use App\Domain\Entity\NonTerminalExpression;
use App\Domain\Entity\TerminalExpression;
use App\Domain\Exceptions\MissingArgumentsException;
use App\Infrastructure\Core\Context;
use App\Infrastructure\Functions\Interface\CallableFunctionInterface;

class ConcatFunc implements CallableFunctionInterface
{
    public function run(array $args, Context $context): mixed
    {
        $parts = [];

        if (!$args) {
            throw new MissingArgumentsException();
        }

        foreach ($args as $arg) {
            if ($arg instanceof TerminalExpression || $arg instanceof NonTerminalExpression) {
                $value = $arg->evaluate($context);
            } else {
                $value = $arg;
            }

            $parts[] = (string)$value;
        }

        return implode('', $parts);
    }
}
