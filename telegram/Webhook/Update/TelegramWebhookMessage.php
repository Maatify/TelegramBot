<?php
/**
 * @PHP       Version >= 8.0
 * @Liberary  TelegramBot
 * @Project   TelegramBot
 * @copyright ©2024 Maatify.dev
 * @see       https://www.maatify.dev Visit Maatify.dev
 * @link      https://github.com/Maatify/TelegramBot View project on GitHub
 * @since     2024-07-29 1:39 PM
 * @author    Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @Maatify   TelegramBot :: TelegramWebhookFrom
 * @note      This Project using for Call Telegram API
 *
 * This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

namespace Maatify\TelegramBot\Webhook\Update;

use Maatify\Logger\Logger;

class TelegramWebhookMessage
{
    private static self $instance;
    public ?string $text;
    public ?int $date;
    public TelegramWebhookChat $chat;
    public TelegramWebhookFrom $from;
    public TelegramWebhookReplyToMessage $message_to_reply;
    public ?int $message_id;
    public ?array $entities;
    public TelegramWebhookForwardOrigin $forward_origin;
    public TelegramWebhookForwardFrom $forward_from;
    public ?int $forward_date;
    public TelegramWebhookDocument $document;
    public ?string $caption;
    public ?string $media_group_id;
    public TelegramWebhookFile $photo;
    public ?string $reply_markup;


    public static function getInstance(): self
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function preload(array $message): self
    {
        Logger::RecordLog($message, 'telegram/webhook/message/' . intval(microtime(true) * 1000));
        $this->message_id = isset($message['message_id']) ? (int)$message['message_id'] : null;
        $this->date = isset($message['date']) ? (int)$message['date'] : null;
        $this->text = isset($message['text']) ? (string)$message['text'] : null;
        $this->entities = isset($message['entities']) ? (array)$message['entities'] : null;
        $this->from = (new TelegramWebhookFrom())->preload($message['from'] ?? []);
        $this->chat = (new TelegramWebhookChat())->preload($message['chat'] ?? []);
        $this->message_to_reply = (new TelegramWebhookReplyToMessage())->preload($message['reply_to_message'] ?? []);
        $this->forward_origin = (new TelegramWebhookForwardOrigin())->preload($message['forward_origin'] ?? []);
        $this->forward_from = (new TelegramWebhookForwardFrom())->preload($message['forward_from'] ?? []);
        $this->forward_date = isset($message['forward_date']) ? (int)$message['forward_date'] : null;
        $this->document = (new TelegramWebhookDocument())->preload($message['document'] ?? []);
        $this->caption = isset($message['caption']) ? (string)$message['caption'] : null;
        $this->media_group_id = isset($message['media_group_id']) ? (string)$message['media_group_id'] : null;
        $this->photo = (new TelegramWebhookFile())->preload($message['photo'][0] ?? []);

        return $this;
    }

    public function getAllAsArray(): array
    {
        return [
            'message_id'       => $this->message_id,
            'date'             => $this->date,
            'text'             => $this->text,
            'entities'         => $this->entities,
            'from'             => $this->from->getAllAsArray(),
            'chat'             => $this->chat->getAllAsArray(),
            'message_to_reply' => $this->message_to_reply->getAllAsArray(),
            'forward_origin'   => $this->forward_origin->getAllAsArray(),
            'forward_from'     => $this->forward_from->getAllAsArray(),
            'forward_date'     => $this->forward_date,
            'document'         => $this->document->getAllAsArray(),
            'caption'          => $this->caption,
            'media_group_id'   => $this->media_group_id,
            'photo'            => $this->photo->getAllAsArray(),
        ];
    }
}