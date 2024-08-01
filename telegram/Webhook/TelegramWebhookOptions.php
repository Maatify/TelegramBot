<?php
/**
 * @PHP       Version >= 8.0
 * @Liberary  TelegramBot
 * @Project   TelegramBot
 * @copyright ©2024 Maatify.dev
 * @see       https://www.maatify.dev Visit Maatify.dev
 * @link      https://github.com/Maatify/TelegramBot View project on GitHub
 * @since     2023-07-16 5:52 AM
 * @author    Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @Maatify   TelegramBot :: TelegramWebhookOptions
 * @note      This Project using for Call Telegram API
 *
 * This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

namespace Maatify\TelegramBot\Webhook;

use Maatify\TelegramBot\TelegramRequest;

class TelegramWebhookOptions
{
    private static self $instance;
    private TelegramRequest $telegram;

    private SetWebhook $setWebhookOptions;
    public static function obj(TelegramRequest $telegram): self
    {
        if (empty(self::$instance)) {
            self::$instance = new self($telegram);
        }

        return self::$instance;
    }

    public function __construct(TelegramRequest $telegram)
    {
        $this->telegram = $telegram;
        $this->setWebhookOptions = SetWebhook::obj($telegram);
    }

    public function OptionsSetter(): SetWebhook
    {
        return $this->setWebhookOptions;
    }

    public function SetWebhook(string $url)
    {
        return $this->setWebhookOptions->SetWebhook($url);
    }

    public function WebhookInfo()
    {
        return $this->telegram->curlGet('getWebhookInfo');
    }

    public function DeleteWebhook()
    {
        return $this->telegram->curlGet('deleteWebhook');
    }

}