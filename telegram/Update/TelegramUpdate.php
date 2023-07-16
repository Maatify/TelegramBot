<?php
/**
 * Created by Maatify.dev
 * User: Maatify.dev
 * Date: 2023-07-15
 * Time: 10:30 AM
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

namespace Maatify\TelegramBot\Update;

class TelegramUpdate extends TelegramUpdateGetter
{
    private static self $instance;

    private int $update_id;
    public TelegramUpdateMessage $message;
    public TelegramUpdateFrom $from;
    public TelegramUpdateChat $chat;
    private string $text;
    private int $date;

    public static function obj(array $update): self
    {
        if (empty(self::$instance)) {
            self::$instance = new self($update);
        }

        return self::$instance;
    }
    public function __construct(array $update)
    {
        parent::__construct($update);
        $this->update_id = $update['update_id'];
        $this->message = TelegramUpdateMessage::obj($update['message']);
        $this->from = TelegramUpdateFrom::obj($this->message->Get('from'));
        $this->chat = TelegramUpdateChat::obj($this->message->Get('chat'));
        $this->text = $this->message->Get('text');
        $this->date = $this->message->Get('date');

    }

    public function Message(): TelegramUpdateMessage
    {
        return $this->message;
    }

    public function GetMessage()
    {
        return $this->message->Get();
    }

    public function GetMessageID()
    {
        return $this->message->Get('message_id');
    }

    public function UpdateID(){
        return $this->update_id;
    }

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