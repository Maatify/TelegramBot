<?php
/**
 * @PHP       Version >= 8.0
 * @Liberary  TelegramBot
 * @Project   TelegramBot
 * @copyright ©2024 Maatify.dev
 * @see       https://www.maatify.dev Visit Maatify.dev
 * @link      https://github.com/Maatify/TelegramBot View project on GitHub
 * @since     2024-07-29 3:01 AM
 * @author    Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @Maatify   TelegramBot :: Webhook
 * @note      This Project using for Call Telegram API
 *
 * This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

namespace Maatify\TelegramBot\Webhook;
abstract class Webhook
{
    protected array $payload;
    protected array $headers;
    protected string $api_key;

    public function __construct(array $payload, array $headers, string $api_key)
    {
        $this->payload = $payload;
        $this->headers = $headers;
        $this->api_key = $api_key;
    }

    abstract public function process();

    protected function validate(): bool
    {
        // Implement validation logic
        return true;
    }
}