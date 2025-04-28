<?php

declare (strict_types = 1);

namespace App\Domain\Exceptions;

class NoCodeException extends \Exception
{
    public function __construct()
    {
        parent::__construct('No code found for execution!');
    }

}