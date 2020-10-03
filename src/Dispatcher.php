<?php

namespace Molinem\MoliBot;

use Symfony\Component\HttpFoundation\Request;
use GuzzleHttp\Client;

final class Dispatcher
{
    /**
     * @var CommandParser
     */
    private $commandParser;

    /**
     * Assign a command parser to be used in dispatch method.
     *
     * @param CommandParser $parser.
     */
    public function setParser(CommandParser $parser)
    {
        $this->commandParser = $parser;
    }

    /**
     * Dispatches the callback processing the command.
     *
     * @param string $command The command to execute
     * @return mixed
     */
    public function dispatch(string $command)
    {
        $callback = $this->commandParser->process($command);

        if ($callback !== null) {
            return call_user_func_array($callback, [
                Request::createFromGlobals(),
                new Client(['verify' => false]),
            ]);
        }

        // TODO
        // maybe you want to return a default callback
        // if the command is not found.
        return null;
    }
}
