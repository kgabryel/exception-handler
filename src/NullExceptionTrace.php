<?php

namespace Frankie\ExceptionHandler;

class NullExceptionTrace implements ExceptionTraceInterface
{

    public function __toString(): string
    {
        return '';
    }
}
