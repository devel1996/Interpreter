<?php

declare(strict_types=1);

namespace App\Infrastructure\Functions;

use App\Domain\Entity\NonTerminalExpression;
use App\Domain\Entity\TerminalExpression;
use App\Infrastructure\Core\Context;
use App\Infrastructure\Functions\Interface\CallableFunctionInterface;

class GetArgFunc implements CallableFunctionInterface
{
    public function run(array $args, Context $context): mixed
    {
        $index = $args[0];

        if ($index instanceof TerminalExpression || $index instanceof NonTerminalExpression) {
            $index = $index->evaluate($context);
        }

        foreach ($context->getArgs() as $i => $arg) {
            if ($i == $index) {
                $result = $arg;
            }
        }

        return $result ?? null;
    }

}
