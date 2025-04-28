<?php

declare(strict_types=1);

namespace App\Infrastructure\Functions\Interface;

use App\Infrastructure\Core\Context;

interface CallableFunctionInterface
{
    public function run(array $args, Context $context): mixed;
}
