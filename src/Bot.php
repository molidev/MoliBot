<?php

namespace Molinem\MoliBot;

final class Bot
{
    private $parser;
    private $dispatcher;
    private $botToken;
    private $baseUrl;

    public function __construct(string $token, CommandParser $parser)
    {
        $this->botToken = $token;
        $this->parser = $parser;
        $this->dispatcher = new Dispatcher();
        $this->dispatcher->setParser($this->parser);
        $this->baseUrl = "https://api.telegram.org/bot{$this->botToken}";
    }

    private function sendMessage($chatId, $message, $keyboard = null)
    {
        $keyboardParams = [];
        if (isset($keyboard)) {
            $keyboardParams = [
                'reply_markup' =>'{"keyboard":['.$keyboard.'],"resize_keyboard":true,"one_time_keyboard":true}',
            ];
        }

        $url = WEBSITE .'/sendMessage';
        $params = [
          'chat_id' => $chatId,
          'parse_mode' => 'html',
          'text' => urlencode($message),
        ];

        return $this->send($url, $params);
    }

    private function send(string $url, array $params)
    {
        $query = http_build_query($params);
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => ($query), // public static function execute
            CURLOPT_URL => $url,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HEADER => false,
        ]);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function start()
    {
        $botToken = "703445272:AAEP0lBC5euvTCx1omRNdF5XmrkRoeqeLjc";
        define('WEBSITE', "https://api.telegram.org/bot{$botToken}");

        $update = file_get_contents('php://input');
        $update = json_decode($update, true);
        $modo = 0;

        $chatId = $update["message"]["chat"]["id"];
        $chatType = $update["message"]["chat"]["type"];
        $userId = $update["message"]['from']['id'];
        $firstname = $update["message"]['from']['username'];
        if ($firstname=="") {
            $modo=1;
            $firstname = $update["message"]['from']['first_name'];
        }

        if ($modo == 0) {
            $firstname = "@".$firstname;
        }

        $message = $update["message"]["text"];

        $agg = json_encode($update, JSON_PRETTY_PRINT);
        $this->sendMessage($chatId, $message);

        // file_put_contents('logs.log', explode(' ', trim($message))[0]);
        $this->dispatcher->dispatch(explode(' ', trim($message))[0]);
    }
}
