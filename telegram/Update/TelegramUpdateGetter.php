<?php
/**
 * @PHP       Version >= 8.0
 * @Liberary  TelegramBot
 * @Project   TelegramBot
 * @copyright ©2024 Maatify.dev
 * @see       https://www.maatify.dev Visit Maatify.dev
 * @link      https://github.com/Maatify/TelegramBot View project on GitHub
 * @since     2023-07-15 10:22 AM
 * @author    Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @Maatify   TelegramBot :: TelegramUpdateGetter
 * @note      This Project using for Call Telegram API
 *
 * This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

namespace Maatify\TelegramBot\Update;

class TelegramUpdateGetter
{
    private static self $instance;
    private mixed $getter;

    public static function obj(array $getter): self
    {
        if (empty(self::$instance)) {
            self::$instance = new self($getter);
        }

        return self::$instance;
    }

    public function __construct($getter)
    {
        $this->getter = $getter;
    }

    public function Get(string $key = '')
    {
        if(empty($key)){
            return $this->getter;
        }else{
            return $this->getter[$key] ?? '';
        }

    }
}