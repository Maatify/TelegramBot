<?php
/**
 * @PHP       Version >= 8.0
 * @Liberary  TelegramBot
 * @Project   TelegramBot
 * @copyright ©2024 Maatify.dev
 * @see       https://www.maatify.dev Visit Maatify.dev
 * @link      https://github.com/Maatify/TelegramBot View project on GitHub
 * @since     2023-07-19 6:32 AM
 * @author    Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @Maatify   TelegramBot :: TelegramUpdateReplyToMessage
 * @note      This Project using for Call Telegram API
 *
 * This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

namespace Maatify\TelegramBot\Update;

class TelegramUpdateReplyToMessage extends TelegramUpdateGetter
{
    use TelegramUpdateTrait;
    private static self $instance;
    private TelegramUpdateFrom $from;
    private TelegramUpdateChat $chat;

    private string $text;

    private string $date;

    public static function obj(array $reply_to_message): self
    {
        if (empty(self::$instance)) {
            self::$instance = new self($reply_to_message);
        }

        return self::$instance;
    }

    public function __construct(array $reply_to_message)
    {
        parent::__construct($reply_to_message);
        $this->from = new TelegramUpdateFrom($this->Get('from') ? : []);
        $this->chat = new TelegramUpdateChat($this->Get('chat') ? : []);
        $this->text = $this->Get('text');
        $this->date = $this->Get('date');
    }

    public function GetMessageID()
    {
        return $this->Get('message_id');
    }

}