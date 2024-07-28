<?php

/**
 * @PHP       Version >= 8.0
 * @Liberary  TelegramBot
 * @Project   TelegramBot
 * @copyright ©2024 Maatify.dev
 * @see       https://www.maatify.dev Visit Maatify.dev
 * @link      https://github.com/Maatify/TelegramBot View project on GitHub
 * @since     2024-07-30 10:24 AM
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

class TelegramWebhookCallback
{
    public ?int $id;
    public TelegramWebhookMessage $message;
    public ?string $chat_instance;
    public ?string $data;


    public function preload(array $callback): self
    {
        $this->id = isset($callback['id']) ? (int)$callback['id'] : null;
        $this->message = (new TelegramWebhookMessage())->preload($callback['message'] ?? []);
        $this->chat_instance = isset($callback['chat_instance']) ? (string)$callback['chat_instance'] : null;
        $this->data = isset($callback['data']) ? (string)$callback['data'] : null;
        $this->message->reply_markup = isset($callback['message']['reply_markup']) ? json_encode($callback['message']['reply_markup']) : null;

        return $this;
    }

    public function getAllAsArray(): array
    {
        return [
            'id'            => $this->id,
            'message'       => $this->message->getAllAsArray(),
            'chat_instance' => $this->chat_instance,
            'data'          => $this->data,
        ];
    }
}