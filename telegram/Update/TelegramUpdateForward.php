<?php
/**
 * @PHP       Version >= 8.0
 * @Liberary  TelegramBot
 * @Project   TelegramBot
 * @copyright ©2024 Maatify.dev
 * @see       https://www.maatify.dev Visit Maatify.dev
 * @link      https://github.com/Maatify/TelegramBot View project on GitHub
 * @since     2023-07-19 8:05 AM
 * @author    Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @Maatify   TelegramBot :: TelegramUpdateForward
 * @note      This Project using for Call Telegram API
 *
 * This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 *
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