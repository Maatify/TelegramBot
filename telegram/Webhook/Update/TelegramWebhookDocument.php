<?php
/**
 * @PHP       Version >= 8.0
 * @Liberary  TelegramBot
 * @Project   TelegramBot
 * @copyright ©2024 Maatify.dev
 * @see       https://www.maatify.dev Visit Maatify.dev
 * @link      https://github.com/Maatify/TelegramBot View project on GitHub
 * @since     2024-07-30 8:19 AM
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

class TelegramWebhookDocument
{
    public ?string $file_name;
    public ?string $mime_type;
    public ?string $thumbnail_file_id;
    public ?string $thumbnail_file_unique_id;
    public ?int $thumbnail_file_size;
    public ?int $thumbnail_width;
    public ?int $thumbnail_height;
    public TelegramWebhookFile $thumbnail;
    public TelegramWebhookFile $thumb;
    public ?string $thumb_file_id;
    public ?string $thumb_file_unique_id;
    public ?int $thumb_file_size;
    public ?int $thumb_width;
    public ?int $thumb_height;
    public ?string $file_id;
    public ?string $file_unique_id;
    public ?int $file_size;

    public function preload(array $document): self
    {
        $this->file_name = isset($document['file_name']) ? (string) $document['file_name'] :  null;
        $this->mime_type = isset($document['mime_type']) ? (string) $document['mime_type'] :  null;
        $this->thumbnail = (new TelegramWebhookFile())->preload($document['thumbnail'] ?? []);
        $this->thumbnail_file_id = $this->thumbnail->file_id;
        $this->thumbnail_file_unique_id = $this->thumbnail->file_unique_id;
        $this->thumbnail_file_size = $this->thumbnail->file_size;
        $this->thumbnail_width = $this->thumbnail->width;
        $this->thumbnail_height = $this->thumbnail->height;
        $this->thumb = (new TelegramWebhookFile())->preload($document['thumb'] ?? []);
        $this->thumb_file_id = $this->thumb->file_id;
        $this->thumb_file_unique_id = $this->thumb->file_unique_id;
        $this->thumb_file_size = $this->thumb->file_size;
        $this->thumb_width = $this->thumb->width;
        $this->thumb_height = $this->thumb->height;
        $this->file_id = isset($document['file_id']) ? (string) $document['file_id'] :  null;
        $this->file_unique_id = isset($document['file_unique_id']) ? (string) $document['file_unique_id'] :  null;
        $this->file_size = isset($document['file_size']) ? (int) $document['file_size'] :  null;

        return $this;
    }

    public function getAllAsArray(): array
    {
        return get_object_vars($this);
    }
}