<?php

namespace App\Domain\Exceptions;

class InvalidFileException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Invalid file extension!');
    }
}