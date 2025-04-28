<?php

declare(strict_types=1);

namespace App\Domain\Exceptions;

class SyntaxErrorException extends \LogicException
{
    public function __construct($error)
    {
        parent::__construct($error);
    }

}