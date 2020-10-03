<?php

namespace Molinem\MoliBot;

class Command
{
    /**
     * @var string
     */
    private $pattern;

    /**
     * @var callable
     */
    private $action;

    /**
     * Initializes the command.
     *
     * @param string $pattern The pattern (example: "/services")
     * @param callable $action
     */
    public function __construct(string $pattern, callable $action)
    {
        $this->pattern = $pattern;
        $this->action = $action;
    }

    /**
     * Gets the string pattern (command pattern)
     *
     * @return string
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    /**
     * Gets the command name. It is the command without the "/" character.
     *
     * @return string
     */
    public function getCommandName()
    {
        return mb_substr($this->pattern, 1);
    }

    /**
     * Gets the action (closure)
     *
     * @return callable
     */
    public function getAction()
    {
        return $this->action;
    }
}
