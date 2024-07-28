<?php
/**
 * @PHP       Version >= 8.0
 * @Liberary  TelegramBot
 * @Project   TelegramBot
 * @copyright ©2024 Maatify.dev
 * @see       https://www.maatify.dev Visit Maatify.dev
 * @link      https://github.com/Maatify/TelegramBot View project on GitHub
 * @since     2024-07-29 2:04 PM
 * @author    Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @Maatify   TelegramBot :: TelegramWebhookReplyToMessage
 * @note      This Project using for Call Telegram API
 *
 * This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

namespace Maatify\TelegramBot\Webhook\Update;

class TelegramWebhookReplyToMessage
{
    public ?int $message_id;
    public ?int $date;
    public ?int $edit_date;
    public ?string $text;
    public TelegramWebhookFrom $from;
    public TelegramWebhookChat $chat;
    public ?array $entities;

    public function preload(array $reply_to_message): self
    {
        $this->message_id = isset($reply_to_message['message_id']) ? (int) $reply_to_message['message_id'] : null;
        $this->date = isset($reply_to_message['date']) ? (int) $reply_to_message['date'] : null;
        $this->edit_date = isset($reply_to_message['edit_date']) ? (int) $reply_to_message['edit_date'] : null;
        $this->text = isset($reply_to_message['text']) ? (string) $reply_to_message['text'] : null;
        $this->from = (new TelegramWebhookFrom())->preload($reply_to_message['from'] ?? []);
        $this->chat = (new TelegramWebhookChat())->preload($reply_to_message['chat'] ?? []);
        $this->entities = isset($reply_to_message['entities']) ? ((array)$reply_to_message['entities']) : null;
        return $this;
    }

    public function getAllAsArray(): array
    {
        return [
            'message_id' => $this->message_id,
            'date' => $this->date,
            'edit_date' => $this->edit_date,
            'text' => $this->text,
            'from' => $this->from->getAllAsArray(),
            'chat' => $this->chat->getAllAsArray(),
            'entities' => $this->entities,
        ];
    }
}