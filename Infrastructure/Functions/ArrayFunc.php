<?php

declare(strict_types=1);

namespace App\Infrastructure\Functions;

use App\Domain\Entity\NonTerminalExpression;
use App\Domain\Entity\TerminalExpression;
use App\Domain\Exceptions\EmptyArrayException;
use App\Infrastructure\Core\Context;
use App\Infrastructure\Functions\Interface\CallableFunctionInterface;

class ArrayFunc implements CallableFunctionInterface
{
    public function run(array $args, Context $context): mixed
    {

        $evaluated = [];

        if (!$args) {
            throw new EmptyArrayException();
        }

        foreach ($args as $arg) {
            if ($arg instanceof TerminalExpression || $arg instanceof NonTerminalExpression) {
                $evaluated[] = $arg->evaluate($context);
            } else {
                $evaluated[] = $arg;
            }
        }

        return $evaluated;
    }

}
