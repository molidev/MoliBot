<?php

require 'vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use GuzzleHttp\Client;
use Molinem\MoliBot\CommandParser;
use Molinem\MoliBot\Command;
use Molinem\MoliBot\Bot;

$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

$command = new Command('/servicios', function (Request $request, Client $client) {
    $reqBody = json_decode($request->getContent());
    $chatId = $reqBody->message->chat->id;
    $chatType = $reqBody->message->chat->type;
    $userId = $reqBody->message->from->id;
    $firstName = $reqBody->message->from->username;

    $url = "https://api.telegram.org/bot". getenv('BOT_TOKEN') ."/sendMessage";
    $response = " 🔸 Estado de los Servicios 🔸 ";
    $params = [
      'chat_id' => $chatId,
      'parse_mode' => 'html',
      'text' => $response,
    ];

    $client->request('GET', $url, ['query' => $params]);
    $estado = shell_exec(__DIR__ .'/Scripts/hello.sh');
    $params = [
      'chat_id' => $chatId,
      'parse_mode' => 'html',
      'text' => $estado,
    ];

    $client->request('GET', $url, ['query' => $params]);
});

$helpCommand = new Command('/ayuda', function (Request $request, Client $client) {
    $reqBody = json_decode($request->getContent());
    $chatId = $reqBody->message->chat->id;
    $chatType = $reqBody->message->chat->type;
    file_put_contents('logs.log', $chatType);
    $response = "- Ayuda -.";
    $url = "https://api.telegram.org/bot". getenv('BOT_TOKEN') ."/sendMessage";
    $params = [
      'chat_id' => $chatId,
      'parse_mode' => 'html',
      'text' => $response,
    ];

    $client->request('GET', $url, ['query' => $params]);
});

// create the command parser
$parser = new CommandParser();
// register/add commands to the parser
$parser
    ->addCommand($command)
    ->addCommand($helpCommand);

// create the bot and start the it
$bot = new Bot(getenv('BOT_TOKEN'), $parser);
$bot->start();
