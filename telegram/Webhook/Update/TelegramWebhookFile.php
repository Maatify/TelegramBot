<?php
/**
 * @PHP       Version >= 8.0
 * @Liberary  TelegramBot
 * @Project   TelegramBot
 * @copyright ©2024 Maatify.dev
 * @see       https://www.maatify.dev Visit Maatify.dev
 * @link      https://github.com/Maatify/TelegramBot View project on GitHub
 * @since     2024-07-30 8:29 AM
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

class TelegramWebhookFile
{
    public ?string $file_id;
    public ?string $file_unique_id;
    public ?int $file_size;
    public ?int $width;
    public ?int $height;

    public function preload(array $document): self
    {
        $this->file_id = isset($document['file_id']) ? (string) $document['file_id'] : null;
        $this->file_unique_id = isset($document['file_unique_id']) ? (string) $document['file_unique_id'] : null;
        $this->file_size = isset($document['file_size']) ? (int) $document['file_size'] : null;
        $this->width = isset($document['width']) ? (int) $document['width'] : null;
        $this->height = isset($document['height']) ? (int) $document['height'] : null;
        return $this;
    }

    public function getAllAsArray(): array
    {
        return get_object_vars($this);
    }
}