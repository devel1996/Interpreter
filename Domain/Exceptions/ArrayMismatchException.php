<?php

declare(strict_types=1);

namespace App\Domain\Exceptions;

class ArrayMismatchException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Array size mismatch!');
    }

}