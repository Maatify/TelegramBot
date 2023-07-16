<?php
/**
 * Created by Maatify.dev
 * User: Maatify.dev
 * Date: 2023-07-16
 * Time: 5:52 AM
 * https://www.Maatify.dev
 */

/**
 * @PHP Version >= 8.0
 * @Liberary   TelegramBot
 * @see https://www.maatify.dev Visit Maatify.dev
 * @link https://github.com/Maatify/TelegramBot View project on GitHub
 *
 * @author    Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @copyright ©2023 Maatify.dev
 * @note    This Project using for Call Telegram API
 *
 * This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

namespace Maatify\TelegramBot\Webhook;

use Maatify\TelegramBot\Request;

class TelegramWebhook
{
    private static self $instance;
    private Request $telegram;

    private SetWebhook $setWebhookOptions;
    public static function obj(Request $telegram): self
    {
        if (empty(self::$instance)) {
            self::$instance = new self($telegram);
        }

        return self::$instance;
    }

    public function __construct(Request $telegram)
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
        return $this->telegram->CurlGet('getWebhookInfo');
    }

    public function DeleteWebhook()
    {
        return $this->telegram->CurlGet('deleteWebhook');
    }

}