<?php

declare(strict_types=1);

namespace App\Domain\Exceptions;

class UndefinedFileException extends \Exception
{
    public function __construct()
    {
        parent::__construct('File name does not found!');
    }
}