<?php

declare(strict_types=1);

namespace App\Domain\Service;

use App\Domain\Entity\NonTerminalExpression;
use App\Domain\Entity\TerminalExpression;
use App\Domain\Entity\Token;
use App\Domain\Enum\TokenType;
use App\Domain\Exceptions\SyntaxErrorException;

class Parser
{
    private array $literals;
    private array $tokens = [];
    private int $pos = 0;

    public function __construct(
    ) {
        $this->literals = TokenType::getLiterals();
    }

    public function parse(
         array $tokens): NonTerminalExpression|TerminalExpression
    {
        return $this->parseExpression($tokens);
    }

    public function parseExpression($tokens): NonTerminalExpression|TerminalExpression
    {
        $this->tokens = $tokens;
        $token = $this->peek();

        if ($token->type === TokenType::PAREN_OPEN) {
            $this->next();

            $nameToken = $this->next();
            if ($nameToken->type !== TokenType::IDENTIFIER) {
                throw new SyntaxErrorException("Expected function name after '('.");
            }
            $name = $nameToken->value;

            $this->consume(TokenType::COMMA, "Expected ',' after function name.");

            $args = [];

            if ($this->peek()->type === TokenType::PAREN_CLOSE) {
                $this->next();
                return new NonTerminalExpression($name, $args);
            }

            while (true) {
                $args[] = $this->parseExpression($tokens);

                if ($this->peek()->type === TokenType::COMMA) {
                    $this->next();
                } elseif ($this->peek()->type === TokenType::PAREN_CLOSE) {
                    $this->next();
                    break;
                } else {
                    throw new SyntaxErrorException("Expected ',' or ')' after argument.");
                }
            }

            return new NonTerminalExpression($name, $args);
        }

        return $this->parseLiteral();
    }

    private function parseLiteral(): TerminalExpression
    {
        $token = $this->next();

        return match ($token->type) {
            TokenType::STRING => new TerminalExpression($this->cleanString($token->value)),
            TokenType::NUMBER => new TerminalExpression(
                strpos($token->value, '.') !== false ? (float)$token->value : (int)$token->value),
            TokenType::TRUE => new TerminalExpression(true),
            TokenType::FALSE => new TerminalExpression(false),
            TokenType::NULL => new TerminalExpression(null),
            default => throw new SyntaxErrorException("Unexpected literal or token: " . $token->type->name),
        };
    }

    private function peek(): Token
    {
        return $this->tokens[$this->pos];
    }

    private function next(): Token
    {
        return $this->tokens[$this->pos++];
    }

    private function consume(TokenType $expectedType, string $errorMessage): Token
    {
        $token = $this->peek();
        if ($token->type !== $expectedType) {
            throw new SyntaxErrorException($errorMessage);
        }
        return $this->next();
    }

    private function cleanString(string $value): string
    {
        $value = trim($value);
        if (strlen($value) >= 2 && $value[0] === '"' && $value[-1] === '"') {
            return substr($value, 1, -1);
        }
        return $value;
    }

}
