<?php

declare(strict_types=1);

namespace App\Domain\Exceptions;

class InvalidArgumentException extends \Exception
{
    public function __construct()
    {
        parent::__construct("No argument passed!");
    }
}