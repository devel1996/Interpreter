<?php

declare(strict_types=1);

namespace App\Domain\Exceptions;

class FunctionNotFoundException extends \Exception
{
    public function __construct($name)
    {
        parent::__construct("Function $name is not registered!");
    }
}