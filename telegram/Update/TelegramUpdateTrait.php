<?php
/**
 * @PHP       Version >= 8.0
 * @Liberary  TelegramBot
 * @Project   TelegramBot
 * @copyright ©2024 Maatify.dev
 * @see       https://www.maatify.dev Visit Maatify.dev
 * @link      https://github.com/Maatify/TelegramBot View project on GitHub
 * @since     2023-07-19 6:40 AM
 * @author    Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @Maatify   TelegramBot :: TelegramUpdateTrait
 * @note      This Project using for Call Telegram API
 *
 * This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

namespace Maatify\TelegramBot\Update;

trait TelegramUpdateTrait
{


    public function From(): TelegramUpdateFrom
    {
        return $this->from;
    }

    public function GetFrom()
    {
        return $this->from->Get();
    }

    public function Chat(): TelegramUpdateChat
    {
        return $this->chat;
    }

    public function GetChat()
    {
        return $this->chat->Get();
    }

    public function GetText()
    {
        return $this->text;
    }

    public function GetDate()
    {
        return $this->date;
    }
}