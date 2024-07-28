<?php
/**
 * @PHP       Version >= 8.0
 * @Liberary  TelegramBot
 * @Project   TelegramBot
 * @copyright ©2024 Maatify.dev
 * @see       https://www.maatify.dev Visit Maatify.dev
 * @link      https://github.com/Maatify/TelegramBot View project on GitHub
 * @since     2024-07-29 12:32 PM
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

class TelegramWebhookFrom
{
    public ?int $id = null;
    public ?bool $is_bot = null;
    public ?string $first_name = null;
    public ?string $last_name = null;
    public ?string $username = null;
    public ?string $language_code = null;
    public function preload(array $from): self
    {
        $this->id = isset($from['id']) ? (int)$from['id'] : null;
        $this->is_bot = isset($from['is_bot']) ? (bool)$from['is_bot'] : null;
        $this->first_name = isset($from['first_name']) ? (string)$from['first_name'] : null;
        $this->last_name = isset($from['last_name']) ? (string)$from['last_name'] : null;
        $this->username = isset($from['username']) ? (string)$from['username'] : null;
        $this->language_code = isset($from['language_code']) ? (string)$from['language_code'] : null;
        return $this;
    }

    public function getAllAsArray(): array
    {
        return get_object_vars($this);
    }
}