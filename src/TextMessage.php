<?php

namespace Molinem\MoliBot;

/**
 * TODO
 */
class TextMessage
{
    private $chat_id;
    private $parse_mode;
    private $text;

    public function __construct($chatId, string $text, $requestData, $parseMode = 'html')
    {
        $chatId = $requestData->message->chat->id;
        $chatType = $requestData->message->chat->type;
        $userId = $requestData->message->from->id;
        $firstName = $requestData->message->from->username;

        $this->chat_id = $chatId;
        $this->text = $text;
        $this->parse_mode = $parseMode;
    }

    public function getChatId()
    {
        return $this->chat_id;
    }

    public function getParseMode()
    {
        return $this->parse_mode;
    }

    public function getText()
    {
        return $this->text;
    }
}
