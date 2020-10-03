<?php

namespace Molinem\MoliBot;

final class CommandParser
{
    /**
     * @var array
     */
    private $commands;

    /**
     * Init the array of commands.
     */
    public function __construct()
    {
        $this->commands = [];
    }

    /**
     * Inserts a new command to the list of commands.
     *
     * @param Command $command a new command instance.
     * @return CommandParser Self instance for chaining method.
     */
    public function addCommand(Command $command)
    {
        array_push($this->commands, $command);

        return $this;
    }

    /**
     * Starts to search the command and returns an action.
     * That action will be post processed by the dispatcher.
     *
     * @param string $pattern The string pattern to search. Example:
     *  "/help"
     * @return mixed A callable or null if the command doesn't match.
     */
    public function process(string $pattern)
    {
        foreach ($this->commands as $command) {
            if (strtolower($pattern) === $command->getPattern()) {
                return $command->getAction();
            }
        }

        return null;
    }
}
