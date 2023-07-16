<?php
/**
 * Created by Maatify.dev
 * User: Maatify.dev
 * Date: 2023-07-16
 * Time: 5:51 AM
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

class SetWebhook
{
    private static self $instance;
    private int $max_connections;
    private string $ip;
    private string $secret_token;

    private Request $telegram;
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
    }

    public function SetIp(string $ip): static
    {
        $this->ip = $ip;
        return $this;
    }

    public function SetMaxConnections(int $max_connections): static
    {
        $this->max_connections = $max_connections;
        return $this;
    }

    public function SetSecretToken(string $secret_token): static
    {
        $this->secret_token = $secret_token;
        return $this;
    }

    public function SetWebhook(string $url)
    {
        $params['url'] = $url;
        if(!empty($this->ip)){
            $params['ip'] = $this->ip;
        }
        if(!empty($this->max_connections)){
            $params['max_connections'] = $this->max_connections;
        }
        if(!empty($this->secret_token)){
            $params['secret_token'] = $this->secret_token;
        }
        return $this->telegram->CurlPost('setWebhook', $params);
    }
}