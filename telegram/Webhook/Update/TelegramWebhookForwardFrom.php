<?php
/**
 * @PHP       Version >= 8.0
 * @Liberary  TelegramBot
 * @Project   TelegramBot
 * @copyright ©2024 Maatify.dev
 * @see       https://www.maatify.dev Visit Maatify.dev
 * @link      https://github.com/Maatify/TelegramBot View project on GitHub
 * @since     2024-07-29 4:51 PM
 * @author    Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @Maatify   TelegramBot :: TelegramWebhookForwardFrom
 * @note      This Project using for Call Telegram API
 *
 * This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

namespace Maatify\TelegramBot\Webhook\Update;

class TelegramWebhookForwardFrom
{
    private static self $instance;
    public ?int $id;
    public ?bool $is_bot;
    public ?string $first_name;
    public ?string $last_name;
    public ?string $username;
    public ?string $language_code;

    public static function getInstance(): self
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function preload(array $forward_from): static
    {
        $forward_from = (new TelegramWebhookFrom())->preload($forward_from);
        $this->id = $forward_from->id;
        $this->is_bot = $forward_from->is_bot;
        $this->first_name = $forward_from->first_name;
        $this->last_name = $forward_from->last_name;
        $this->username = $forward_from->username;
        $this->language_code = $forward_from->language_code;
        return $this;
    }
    public function getAllAsArray(): array
    {
        return get_object_vars($this);
    }
}