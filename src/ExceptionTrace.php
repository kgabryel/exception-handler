<?php

namespace Frankie\ExceptionHandler;

class ExceptionTrace
{
    protected int $index;
    protected string $file;
    protected int $line;
    protected ExceptionTraceInterface $exceptionPlace;

    public function __construct(int $index, string $file, int $line)
    {
        $this->index = $index;
        $this->file = $file;
        $this->line = $line;
        $this->exceptionPlace = new NullExceptionTrace();
    }

    public function __clone()
    {
        $this->exceptionPlace = clone $this->exceptionPlace;
    }

    public function setTrace(ExceptionTraceInterface $exceptionTrace): self
    {
        $this->exceptionPlace = $exceptionTrace;
        return $this;
    }

    public function __toString(): string
    {
        return '#' . $this->index . ' ' . $this->file . '(' . $this->line . ')' . $this->exceptionPlace . "\n";
    }
}
