<?php

namespace Molinem\MoliBot;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

final class Dispatcher
{
    private $commandParser;

    public function setParser(CommandParser $parser)
    {
        $this->commandParser = $parser;
    }

    public function dispatch(string $command)
    {
        $callback = $this->commandParser->process($command);

        if ($callback !== null) {
            return call_user_func_array($callback, [
                Request::createFromGlobals(),
                new Response(),
            ]);
        }
    }
}
