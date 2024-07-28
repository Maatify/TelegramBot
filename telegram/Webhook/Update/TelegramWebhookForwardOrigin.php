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
 * @Maatify   TelegramBot :: TelegramWebhookForwardOrigin
 * @note      This Project using for Call Telegram API
 *
 * This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

namespace Maatify\TelegramBot\Webhook\Update;

class TelegramWebhookForwardOrigin
{
    private array $forward_origin;
    public ?string $type;
    public ?int $id;
    public ?int $date;
    public ?bool $is_bot;
    public ?string $first_name;
    public ?string $last_name;
    public ?string $username;
    public ?string $language_code;

    public function preload(array $forward_origin): static
    {
        $this->forward_origin = $forward_origin;
        $forward_sender_user = (new TelegramWebhookFrom)->preload($forward_origin['sender_user'] ?? []);
        $this->type = $this->validateIndexByType('type', 'string');
        $this->date = $this->validateIndexByType('date', 'int');

        $this->id = $forward_sender_user->id;
        $this->is_bot = $forward_sender_user->is_bot;
        $this->first_name = $forward_sender_user->first_name;
        $this->last_name = $forward_sender_user->last_name;
        $this->username = $forward_sender_user->username;
        $this->language_code = $forward_sender_user->language_code;
        return $this;
    }

    private function validateIndexByType(string $index, string $cast_type): bool|int|string|null
    {
        if(isset($this->forward_origin[$index])) {
            return match ($cast_type) {
                'int' => (int)$this->forward_origin[$index],
                'bool' => (bool)$this->forward_origin[$index],
                default => (string)$this->forward_origin[$index],
            };
        }
        return null;
    }

    public function getAllAsArray(): array
    {
        return get_object_vars($this);
    }
}