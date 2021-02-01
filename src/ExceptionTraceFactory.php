<?php

namespace Frankie\ExceptionHandler;

class ExceptionTraceFactory
{
    protected const CLASS_KEY = 'class';
    protected const FUNCTION_KEY = 'function';
    protected const TYPE_KEY = 'type';
    protected const ARGS_KEY = 'args';
    protected array $params;

    public function __construct()
    {
        $this->params = [];
    }

    public function set(array $params): self
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @return ExceptionTraceInterface
     * @throws HandlerException
     */
    public function build(): ExceptionTraceInterface
    {
        if ($this->params === []) {
            return new NullExceptionTrace();
        }
        if (isset($this->params[self::CLASS_KEY])) {
            return new ClassExceptionTrace(
                $this->params[self::CLASS_KEY],
                $this->params[self::FUNCTION_KEY],
                $this->params[self::TYPE_KEY],
                $this->params[self::ARGS_KEY]
            );
        }
        if (isset($this->params[self::FUNCTION_KEY])) {
            return new FunctionExceptionTrace(
                $this->params[self::FUNCTION_KEY], $this->params[self::ARGS_KEY]
            );
        }
        throw new HandlerException('Invalid parameter.');
    }
}
