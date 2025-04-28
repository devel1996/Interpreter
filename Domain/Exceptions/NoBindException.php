<?php

declare(strict_types=1);

namespace App\Domain\Exceptions;

class NoBindException extends \Exception
{
    public function __construct(string $abstract)
    {
        parent::__construct("No binding found with this $abstract!");

    }

}