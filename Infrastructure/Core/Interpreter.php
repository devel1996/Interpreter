<?php

namespace App\Infrastructure\Core;

use App\Domain\Entity\NonTerminalExpression;

class Interpreter
{
    public function __construct(
        private Context $context
    ) {}

    public function run(NonTerminalExpression $program, $argsVo): mixed
    {
        $this->context->setArgs($argsVo);

        return $program->evaluate($this->context);
    }

}