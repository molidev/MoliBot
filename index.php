<?php

require 'vendor/autoload.php';

use Molinem\MoliBot\CommandParser;
use Molinem\MoliBot\Command;
use Molinem\MoliBot\Bot;


$command = new Command('/servicios', function ($request, $response) {
    file_put_contents('logs.log', $request->getContent());
    $data = json_decode($request->getContent());
    $response->setContent('Hello World');
    $response->headers->set('Content-Type', 'text/plain');

    return $response->send();
});

$helpCommand = new Command('/ayuda', function () {
    echo "bye";
});

$parser = new CommandParser();
$parser
    ->addCommand($command)
    ->addCommand($helpCommand);

$bot = new Bot(getenv('BOT_TOKEN'), $parser);
$bot->start();
