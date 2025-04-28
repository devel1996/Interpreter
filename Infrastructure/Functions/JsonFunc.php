<?php

declare(strict_types=1);

namespace App\Infrastructure\Functions;

use App\Domain\Entity\NonTerminalExpression;
use App\Infrastructure\Core\Context;
use App\Infrastructure\Functions\Interface\CallableFunctionInterface;

class JsonFunc implements CallableFunctionInterface
{
    public function run(array $args, Context $context): mixed
    {
        $value = $args[0];

        if ($value instanceof NonTerminalExpression ) {
            $value = $value->evaluate($context);
        }

        return json_encode($value, JSON_THROW_ON_ERROR);
    }

}