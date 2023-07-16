<?php
/**
 * Created by Maatify.dev
 * User: Maatify.dev
 * Date: 2023-07-15
 * Time: 10:19 AM
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

class TelegramUpdateMessage
{
    protected array $message;
    private static self $instance;

    public static function obj(array $message): self
    {
        if (empty(self::$instance)) {
            self::$instance = new self($message);
        }

        return self::$instance;
    }

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function Get(string $key = '')
    {
        if(empty($key)){
            return $this->message;
        }elseif (!empty($this->message[$key])){
            return $this->message[$key];
        }
        return '';
    }
}