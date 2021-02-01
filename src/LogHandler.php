<?php

namespace Frankie\ExceptionHandler;

use Ds\Queue;
use Whoops\Handler\PrettyPageHandler;

class LogHandler extends PrettyPageHandler
{
    protected string $path;
    protected Queue $traces;
    protected ExceptionTraceFactory $factory;

    public function __construct(string $path, Queue $traces, ExceptionTraceFactory $factory)
    {
        parent::__construct();
        $this->path = $path;
        $this->traces = $traces;
        $this->factory = $factory;
    }

    public function __clone()
    {
        $this->traces = clone $this->traces;
        $this->factory = clone $this->factory;
    }

    /**
     * @throws HandlerException
     */
    public function handle(): void
    {
        $info = new ExceptionInfo(
            \get_class($this->getException()),
            $this->getException()
                ->getMessage(),
            $this->getException()
                ->getFile(),
            $this->getException()
                ->getLine()
        );
        $index = 0;
        foreach ($this->getException()
                ->getTrace() as $item
        ) {
            $trace = new ExceptionTrace(
                $index,
                $this->getException()
                    ->getFile(),
                $this->getException()
                    ->getLine()
            );
            $trace->setTrace(
                $this->factory->set($item)
                    ->build()
            );
            $this->traces->push($trace);
            $index++;
        }
        $this->traces->push("#$index {main}\n");
        file_put_contents($this->path, $info, FILE_APPEND);
        while (!$this->traces->isEmpty()) {
            file_put_contents($this->path, $this->traces->pop(), FILE_APPEND);
        }
    }
}
