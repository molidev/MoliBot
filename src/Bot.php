<?php

namespace Molinem\MoliBot;

use Symfony\Component\HttpFoundation\Request;

final class Bot
{

    /**
     * @var CommandParser
     */
    private $parser;

    /**
     * @var Dispatcher
     */
    private $dispatcher;

    /**
     * @var string
     */
    private $botToken;

    /**
     * @var string
     */
    private $baseUrl;

    /**
     * Initializes the bot with all needed objects.
     *
     * @param string $token
     * @param CommandParser $parser the command parser
     */
    public function __construct(string $token, CommandParser $parser)
    {
        $this->botToken = $token;
        $this->parser = $parser;
        $this->dispatcher = new Dispatcher();
        $this->dispatcher->setParser($this->parser);
        $this->baseUrl = "https://api.telegram.org/bot{$this->botToken}";
    }

    /**
     * This method starts the bot application.
     */
    public function start()
    {
        $request = Request::createFromGlobals();
        $data = json_decode($request->getContent());

        $this->dispatcher->dispatch(explode(' ', trim($data->message->text))[0]);
    }
}
