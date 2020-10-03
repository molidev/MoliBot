<?php

namespace Molinem\MoliBot;

use Stringy\Stringy as S;
use Exception;

/**
 * TODO
 */
class Message
{

    public function __construct($data)
    {
    }

    public function sendMessage()
    {
    }

    public static function buildFromRequest($jsonContent, $type = 'text')
    {
        $messageTypeClass = ucfirst($type) .'Message';
        if (!class_exists($messageTypeClass)) {
            throw new Exception('class '. $messageTypeClass .' does not exist');
        }

        return new $messageTypeClass($jsonContent);
    }

    public function getProperty($property, $defaultValue = null)
    {
        return isset($this->property) ? $this->property : $defaultValue;
    }

    public function __call($method, $args)
    {
        // Convert method to snake_case (which is the name of the property)
        $propertyName = strtolower(ltrim(preg_replace('/[A-Z]/', '_$0', substr($method, 3)), '_'));

        $methodType = substr($method, 0, 3);
        if ($methodType === 'get') {
            $property = $this->getProperty($propertyName);

            return $property;
        } elseif ($methodType === 'set') {
        }
    }
}
