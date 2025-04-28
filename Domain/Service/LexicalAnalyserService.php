<?php

declare(strict_types=1);

namespace App\Domain\Service;

use App\Domain\Entity\Token;
use App\Domain\Enum\TokenType;

class LexicalAnalyserService
{
    /**
     * @throws \Exception
     */
    public function tokenize(
        string $code,
        int $pos = 0): array
    {
        $tokens = [];

        $length = strlen($code);

        while ($pos < $length) {
            $char = $code[$pos];

            if (ctype_space($char)) {
                $pos++;
                continue;
            }

            if ($char === '(') {
                $tokens[] = new Token(TokenType::PAREN_OPEN, '(', $pos);
                $pos++;
                continue;
            }

            if ($char === ')') {
                $tokens[] = new Token(TokenType::PAREN_CLOSE, ')', $pos);
                $pos++;
                continue;
            }

            if ($char === ',') {
                $tokens[] = new Token(TokenType::COMMA, ',', $pos);
                $pos++;
                continue;
            }

            if ($char === '"') {
                $startPos = $pos;
                $pos++;
                $value = '';

                while ($pos < $length && $code[$pos] !== '"') {
                    $value .= $code[$pos++];
                }

                if ($pos >= $length) {
                    throw new \Exception('Unterminated string at position ' . $startPos);
                }

                $pos++;
                $tokens[] = new Token(TokenType::STRING, $value, $startPos);
                continue;
            }

            $startPos = $pos;
            $value = '';

            while (
                $pos < $length &&
                !in_array($code[$pos], ['(', ')', ',', '"', ' ', "\n", "\r", "\t"])
            ) {
                $value .= $code[$pos++];
            }

            if ($value === '') {
                throw new \Exception('Unexpected character at position ' . $pos);
            }

            $lower = strtolower($value);
            if ($lower === 'true') {
                $tokens[] = new Token(TokenType::TRUE, $value, $startPos);
            } elseif ($lower === 'false') {
                $tokens[] = new Token(TokenType::FALSE, $value, $startPos);
            } elseif ($lower === 'null') {
                $tokens[] = new Token(TokenType::NULL, $value, $startPos);
            } elseif (is_numeric($value)) {
                $tokens[] = new Token(TokenType::NUMBER, $value, $startPos);
            } else {
                $tokens[] = new Token(TokenType::IDENTIFIER, $value, $startPos);
            }
        }

        $tokens[] = new Token(TokenType::EOF, '', $pos);

        return $tokens;
    }
}
