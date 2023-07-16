<?php
/**
 * Created by Maatify.dev
 * User: Maatify.dev
 * Date: 2023-07-19
 * Time: 8:05 AM
 * https://www.Maatify.dev
 */

namespace Maatify\TelegramBot\Update;

class TelegramUpdateForward extends TelegramUpdateGetter
{
    private static self $instance;
    private array $forward_from_chat;
    private int $forward_from_message_id;
    private string $forward_signature;
    private int $forward_date;

    public static function obj($message): self
    {
        if (empty(self::$instance)) {
            self::$instance = new self($message);
        }

        return self::$instance;
    }

    public function __construct($getter)
    {
        parent::__construct($getter);
        $this->forward_from_chat = $getter['forward_from_chat'] ?? $getter['forward_from'] ?? [];
        $this->forward_from_message_id = $getter['forward_from_message_id'] ?? 0;
        $this->forward_signature = $getter['forward_signature'] ?? '';
        $this->forward_date = $getter['forward_date'] ?? 0;
    }

    public function GetForwardChat()
    {
        return $this->forward_from_chat;
    }

    public function GetForwardChatId()
    {
        return $this->forward_from_chat['id'] ?? '';
    }

    public function GetForwardChatFirstName()
    {
        return $this->forward_from_chat['first_name'] ?? '';
    }

    public function GetForwardChatLastName()
    {
        return $this->forward_from_chat['last_name'] ?? '';
    }

    public function GetForwardChatUsername()
    {
        return $this->forward_from_chat['username'] ?? '';
    }

    public function GetForwardChatType()
    {
        return $this->forward_from_chat['type'] ?? '';
    }

    public function GetForwardFromMessageId()
    {
        return $this->forward_from_message_id;
    }

    public function GetForwardSignature()
    {
        return $this->forward_signature;
    }

    public function GetForwardFromDate()
    {
        return $this->forward_date;
    }

}