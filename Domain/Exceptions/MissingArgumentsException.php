<?php

declare(strict_types=1);

namespace App\Domain\Exceptions;

class MissingArgumentsException extends \Exception
{
    public function __construct()
    {
        parent::__construct("Missing concatenate arguments!");
    }

}