<?php
/**
 * @PHP       Version >= 8.0
 * @Liberary  TelegramBot
 * @Project   TelegramBot
 * @copyright ©2024 Maatify.dev
 * @see       https://www.maatify.dev Visit Maatify.dev
 * @link      https://github.com/Maatify/TelegramBot View project on GitHub
 * @since     2024-07-29 1:33 PM
 * @author    Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @Maatify   TelegramBot :: TelegramWebhookChat
 * @note      This Project using for Call Telegram API
 *
 * This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

namespace Maatify\TelegramBot\Webhook\Update;

class TelegramWebhookChat
{
    public ?int $id = null;
    public ?string $first_name = null;
    public ?string $last_name = null;
    public ?string $username = null;
    public ?string $type = null;

    public function preload(array $chat): self
    {
        $this->id = isset($chat['id']) ? (int) $chat['id'] :  null;
        $this->first_name = isset($chat['first_name']) ? (string) $chat['first_name'] :  null;
        $this->last_name = isset($chat['last_name']) ? (string) $chat['last_name'] :  null;
        $this->username = isset($chat['username']) ? (string) $chat['username'] :  null;
        $this->type = isset($chat['type']) ? (string) $chat['type'] :  null;
        return $this;
    }

    public function getAllAsArray(): array
    {
        return get_object_vars($this);
    }
}