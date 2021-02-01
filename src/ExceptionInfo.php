<?php

namespace Frankie\ExceptionHandler;

class ExceptionInfo
{
    private string $exceptionClass;
    private string $message;
    private string $file;
    private int $line;

    public function __construct(string $exceptionClass, string $message, string $file, int $line)
    {
        $this->exceptionClass = $exceptionClass;
        $this->message = $message;
        $this->file = $file;
        $this->line = $line;
    }

    public function __toString(): string
    {
        return $this->exceptionClass . ': ' . $this->message . ' in ' . $this->file . ':' . $this->line . "\n";
    }
}
