<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 27/02/2018
 * Time: 17:48
 */

namespace App\Matrix;

class Message
{
    public const TYPE_TEXT = 'm.text';
    public const TYPE_NOTICE = 'm.notice';

    protected $type;
    protected $body;
    protected $formatted_body;

    public function __construct($body, $type = self::TYPE_TEXT, $formatted_body = null )
    {
        $this->body = $body;
        $this->formatted_body = $formatted_body;
        $this->setType($type);
    }
    public function getBody()
    {
        return $this->body;
    }
    public function getFormattedBody()
    {
        return $this->formatted_body;
    }
    public function getType()
    {
        return $this->type;
    }
    public function setType($type)
    {
        if (!in_array($type, [self::TYPE_TEXT, self::TYPE_NOTICE])) {
            throw new \Exception("Invalid type");
        }
        $this->type = $type;
    }
    public function storeChatMessage()
    {
    }
}
