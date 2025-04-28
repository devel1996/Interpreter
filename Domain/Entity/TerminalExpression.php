<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Infrastructure\Core\Context;

class TerminalExpression
{
    public function __construct(
        private $value
    ) {
    }

    public function evaluate(Context $context): mixed
    {
        return $this->value;
    }

}
