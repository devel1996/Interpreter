<?php

namespace App\Domain\Exceptions;

class WrongArgumentException extends \Exception
{
    public function __construct()
    {
        parent::__construct("Wrong way to pass the argument missing --");
    }

}