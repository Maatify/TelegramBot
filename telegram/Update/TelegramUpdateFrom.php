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
 * @Maatify   TelegramBot :: TelegramUpdateFrom
 * @note      This Project using for Call Telegram API
 *
 * This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

namespace Maatify\TelegramBot\Update;

class TelegramUpdateFrom extends TelegramUpdateGetter
{
    private static self $instance;
    private array $from;

    public static function obj(array $from): self
    {
        if (empty(self::$instance)) {
            self::$instance = new self($from);
        }

        return self::$instance;
    }

    public function __construct(array $from)
    {
        $this->from = $from;
        parent::__construct($from);
    }

    public function ID()
    {
        return $this->Get('id') ? : 0;
    }

    public function IsBot()
    {
        return $this->Get('is_bot') ? : false;
    }

    public function FirstName()
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

    public function LanguageCode()
    {
        return $this->Get('language_code') ? : '';
    }
}