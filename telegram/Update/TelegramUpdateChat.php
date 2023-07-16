<?php
/**
 * Created by Maatify.dev
 * User: Maatify.dev
 * Date: 2023-07-15
 * Time: 11:23 AM
 * https://www.Maatify.dev
 */

/**
 * @PHP Version >= 8.0
 * @Project   TelegramBot
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

namespace Maatify\TelegramBot\Update;

class TelegramUpdateChat extends TelegramUpdateGetter
{
    private static self $instance;
    private array $chat;

    public static function obj(array $chat): self
    {
        if (empty(self::$instance)) {
            self::$instance = new self($chat);
        }

        return self::$instance;
    }
    
    public function __construct(array $chat)
    {
        parent::__construct($chat);
        $this->chat = $chat;
    }

    public function ID()
    {
        return $this->Get('id') ? : 0;
    }public function FirstName()
{
    return $this->Get('first_name') ? : '';
}

    public function LastName()
    {
        return $this->Get('last_name') ? : '';
    }

    public function Username()
    {
        return $this->Get('username') ? : '';
    }

    public function Type()
    {
        return $this->Get('type') ? : '';
    }
}