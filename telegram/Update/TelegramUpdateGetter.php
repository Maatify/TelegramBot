<?php
/**
 * Created by Maatify.dev
 * User: Maatify.dev
 * Date: 2023-07-15
 * Time: 10:22 AM
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