<?php

declare(ticks=1);

namespace App\Domain\Enum;

enum TokenType
{
    case PAREN_OPEN;
    case PAREN_CLOSE;
    case COMMA;
    case IDENTIFIER;

    case STRING;
    case NUMBER;

    case TRUE;
    case FALSE;
    case NULL;

    case EOF;

    public static function getLiterals(): array
    {
        return [
            self::STRING->name => self::STRING,
            self::NUMBER->name => self::NUMBER,
            self::TRUE->name => self::TRUE,
            self::FALSE->name => self::FALSE,
            self::NULL->name => self::NULL,
        ];
    }
}
