<?php

namespace Frankie\ExceptionHandler;

class FunctionExceptionTrace implements ExceptionTraceInterface
{
    protected string $function;
    protected string $args;

    public function __construct(string $function, array $args)
    {
        $this->function = $function;
        $this->args = implode(', ', $args);
    }

    public function __toString(): string
    {
        return ': ' . $this->function . '(' . $this->args . ')';
    }
}
