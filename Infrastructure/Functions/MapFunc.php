<?php

declare(strict_types=1);

namespace App\Infrastructure\Functions;

use App\Domain\Entity\NonTerminalExpression;
use App\Domain\Entity\TerminalExpression;
use App\Domain\Exceptions\ArrayMismatchException;
use App\Infrastructure\Core\Context;
use App\Infrastructure\Functions\Interface\CallableFunctionInterface;

class MapFunc implements CallableFunctionInterface
{
    public function run(array $args, Context $context): mixed
    {
        $result = [];

        $arrays = [];
        foreach ($args as $arg) {
            if ($arg instanceof TerminalExpression || $arg instanceof NonTerminalExpression) {
                $arrays[] = $arg->evaluate($context);
            } else {
                $arrays[] = $arg;
            }
        }

        for ($i = 0; $i < count($arrays); $i += 2) {
            $keys = $arrays[$i];
            $values = $arrays[$i + 1];

            if (count($keys) !== count($values)) {
                throw new ArrayMismatchException();
            }

            $result = array_merge($result, array_combine($keys, $values));
        }

        return $result;
    }

}