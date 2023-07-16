<?php
/**
 * Created by Maatify.dev
 * User: Maatify.dev
 * Date: 2023-07-19
 * Time: 6:32 AM
 * https://www.Maatify.dev
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