<?php
/**
 * Created by Maatify.dev
 * User: Maatify.dev
 * Date: 2023-07-19
 * Time: 1:07 PM
 * https://www.Maatify.dev
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