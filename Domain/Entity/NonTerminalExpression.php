<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Infrastructure\Core\Context;

class NonTerminalExpression
{
    public function __construct(
        private string $name,
        private array $args
    ) {
    }

    public function evaluate(Context $context): mixed
    {
        $function = $context->getFunction($this->name);

        return $function->run($this->args, $context);
    }
}