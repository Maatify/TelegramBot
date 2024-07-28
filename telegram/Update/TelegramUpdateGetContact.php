<?php
/**
 * @PHP       Version >= 8.0
 * @Liberary  TelegramBot
 * @Project   TelegramBot
 * @copyright ©2024 Maatify.dev
 * @see       https://www.maatify.dev Visit Maatify.dev
 * @link      https://github.com/Maatify/TelegramBot View project on GitHub
 * @since     2023-07-19 1:07 PM
 * @author    Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @Maatify   TelegramBot :: TelegramUpdateGetContact
 * @note      This Project using for Call Telegram API
 *
 * This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

namespace Maatify\TelegramBot\Update;

class TelegramUpdateGetContact extends TelegramUpdateGetter
{
    private static self $instance;

    private array $contact;

    public static function obj($contact): self
    {
        if (empty(self::$instance)) {
            self::$instance = new self($contact);
        }

        return self::$instance;
    }

    public function __construct($getter)
    {
        parent::__construct($getter);
        $this->contact = $getter;
    }

    public function PhoneNumber()
    {
        return $this->Get('phone_number');
    }

    public function FirstName()
    {
        return $this->Get('first_name');
    }

    public function LastName()
    {
        return $this->Get('last_name');
    }

    public function UserId()
    {
        return $this->Get('user_id');
    }
}