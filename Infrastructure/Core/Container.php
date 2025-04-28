<?php

declare(strict_types=1);

namespace App\Infrastructure\Core;

use App\Domain\Exceptions\NoBindException;

class Container
{
    private array $bindings = [];
    private static ?self $instance = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function bind(string $abstract, callable $factory): void
    {
        $this->bindings[$abstract] = $factory;
    }

    public function make(string $abstract): mixed
    {
        if (!isset($this->bindings[$abstract])) {
            throw new NoBindException($abstract);
        }

        return ($this->bindings[$abstract])();
    }
}
