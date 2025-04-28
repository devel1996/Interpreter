<?php

declare(strict_types=1);

namespace App\Domain\Exceptions;

class EmptyArrayException extends \Exception
{
    public function __construct()
    {
        parent::__construct("Array cannot be empty!");
    }

}
