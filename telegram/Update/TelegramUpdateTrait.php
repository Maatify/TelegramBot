<?php
/**
 * Created by Maatify.dev
 * User: Maatify.dev
 * Date: 2023-07-19
 * Time: 6:40 AM
 * https://www.Maatify.dev
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