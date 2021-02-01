<?php

namespace Frankie\ExceptionHandler;

use Ds\Queue;
use Whoops\Handler\Handler;
use Whoops\Handler\JsonResponseHandler;
use Whoops\Handler\PlainTextHandler;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Handler\XmlResponseHandler;

class HandlerQueue
{
    /** @var Queue<Handler> $handler */
    private Queue $handlers;
    protected string $path;

    public function __construct(string $path, Queue $handlers)
    {
        $this->path = $path;
        $this->handlers = $handlers;
    }

    public function __clone()
    {
        $this->handlers = clone $this->handlers;
    }

    public function create(int $debug): self
    {
        if ($debug % 2 === 1) {
            $this->handlers->push(
                new LogHandler($this->path, new Queue(), new ExceptionTraceFactory())
            );
        }
        if ($debug === 2 || $debug === 3) {
            $this->handlers->push(new PrettyPageHandler());
        }
        if ($debug === 4 || $debug === 5) {
            $this->handlers->push(new JsonResponseHandler());
        }
        if ($debug === 6 || $debug === 7) {
            $this->handlers->push(new XmlResponseHandler());
        }
        if ($debug === 8 || $debug === 9) {
            $this->handlers->push(new PlainTextHandler());
        }
        return $this;
    }

    public function pop(): Handler
    {
        return $this->handlers->pop();
    }

    public function isEmpty(): bool
    {
        return $this->handlers->isEmpty();
    }
}
