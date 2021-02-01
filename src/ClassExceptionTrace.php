<?php

namespace Frankie\ExceptionHandler;

class ClassExceptionTrace implements ExceptionTraceInterface
{
    protected string $function;
    protected string $args;
    protected string $className;
    protected string $type;

    public function __construct(string $className, string $function, string $type, array $args)
    {
        $this->function = $function;
        $this->className = $className;
        $this->type = $type;
        $this->args = implode(', ', $args);
    }

    public function __toString(): string
    {
        return ': ' . $this->className . $this->type . $this->function . '(' . $this->args . ')';
    }
}
