<?php
/**
 * @PHP       Version >= 8.0
 * @Liberary  TelegramBot
 * @Project   TelegramBot
 * @copyright ©2024 Maatify.dev
 * @see       https://www.maatify.dev Visit Maatify.dev
 * @link      https://github.com/Maatify/TelegramBot View project on GitHub
 * @since     2023-07-15 10:30 AM
 * @author    Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @Maatify   TelegramBot :: TelegramUpdate
 * @note      This Project using for Call Telegram API
 *
 * This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

namespace Maatify\TelegramBot\Update;

class TelegramUpdate extends TelegramUpdateGetter
{
    use TelegramUpdateTrait;
    private static self $instance;
    protected int $update_id;
    public TelegramUpdateMessage $message;
    public TelegramUpdateFrom $from;
    public TelegramUpdateChat $chat;
    protected string $text;
    protected int $date;
    protected TelegramUpdateReplyToMessage $reply_to_message;
    private TelegramUpdateForward $forward_from_message;
    private TelegramUpdateGetContact $contact;

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
        $this->message = TelegramUpdateMessage::obj(!empty($update['message']) ? $update['message'] : []);
        $this->from = TelegramUpdateFrom::obj(!empty($this->message->Get('from')) ? $this->message->Get('from') : []);
        $this->chat = TelegramUpdateChat::obj(!empty($this->message->Get('chat')) ? $this->message->Get('chat') : []);
        $this->text = $this->message->Get('text') ?? '';
        $this->date = $this->message->Get('date') ?? 0;
        if(empty($this->reply_to_message)) {
            $this->reply_to_message = TelegramUpdateReplyToMessage::obj($this->message->Get('reply_to_message') ?: []);
        }
        if(empty($this->forward_from_message)){
            $this->forward_from_message = TelegramUpdateForward::obj($this->message->Get()? : []);
        }
        if(empty($this->contact)) {
            $this->contact = TelegramUpdateGetContact::obj($this->message->Get('contact')?:[]);
        }

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

    public function ReplyToMessage(): TelegramUpdateReplyToMessage
    {
        return $this->reply_to_message;
    }

    public function ForwardFromMessage(): TelegramUpdateForward
    {
        return $this->forward_from_message;
    }

    public function Contact(): TelegramUpdateGetContact
    {
        return $this->contact;
    }
}