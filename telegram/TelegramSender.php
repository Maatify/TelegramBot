<?php
/**
 * @PHP       Version >= 8.0
 * @Liberary  TelegramBot
 * @Project   TelegramBot
 * @copyright ©2024 Maatify.dev
 * @see       https://www.maatify.dev Visit Maatify.dev
 * @link      https://github.com/Maatify/TelegramBot View project on GitHub
 * @since     2023-07-16 9:55 AM
 * @author    Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @Maatify   TelegramBot :: TelegramSender
 * @note      This Project using for Call Telegram API
 *
 * This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

namespace Maatify\TelegramBot;

use CURLFile;
use Maatify\TelegramBot\InlineKeyboard\TelegramInlineKeyboardMarkup;

class TelegramSender
{
    private static self $instance;
    private TelegramSendAction $action;
    private TelegramRequest $telegram;

    public static function obj(TelegramRequest $telegram): self
    {
        if (empty(self::$instance)) {
            self::$instance = new self($telegram);
        }

        return self::$instance;
    }

    public function __construct(TelegramRequest $telegram)
    {
        $this->telegram = $telegram;
        $this->action = TelegramSendAction::obj($telegram);
    }

    public function sendMessage(int $chat_id, string $text, int $reply_to_message_id = 0, array $keyboard = [], $parseMode = null)
    {
        $to_send['chat_id'] = $chat_id;
        $to_send['text'] = $text;
        if(!empty($reply_to_message_id)) {
            $to_send['reply_to_message_id'] = $reply_to_message_id;
        }
        if(!empty($keyboard)) {
            $to_send['reply_markup'] = TelegramInlineKeyboardMarkup::obj()->createInlineKeyboard($keyboard);
        }

        if (!empty($parseMode)) {
            $to_send['parse_mode'] = $parseMode;
        }

        return $this->telegram->curlPost('sendMessage',
            $to_send
        );
    }
    public function editMessageReplyMarkup(int $chat_id, int $reply_to_message_id = 0, array $keyboard = [], $parseMode = null)
    {
        $to_send['chat_id'] = $chat_id;
        if(!empty($reply_to_message_id)) {
            $to_send['message_id'] = $reply_to_message_id;
        }
        if(!empty($keyboard)) {
            $to_send['reply_markup'] = TelegramInlineKeyboardMarkup::obj()->createInlineKeyboard($keyboard);
        }

        if (!empty($parseMode)) {
            $to_send['parse_mode'] = $parseMode;
        }

        return $this->telegram->curlPost('editMessageReplyMarkup',
            $to_send
        );
    }
    public function editMessageText(int $chat_id, string $text = '', int $reply_to_message_id = 0, array $keyboard = [], $parseMode = null)
    {
        $to_send['chat_id'] = $chat_id;
        if(!empty($text)) {
            $to_send['text'] = $text;
        }
        if(!empty($reply_to_message_id)) {
            $to_send['message_id'] = $reply_to_message_id;
        }
        if(!empty($keyboard)) {
            $to_send['reply_markup'] = TelegramInlineKeyboardMarkup::obj()->createInlineKeyboard($keyboard);
        }

        if (!empty($parseMode)) {
            $to_send['parse_mode'] = $parseMode;
        }
        return $this->telegram->curlPost('editMessageText',
            $to_send
        );
    }

    public function sendMessageWithKeyboardMarkup(int $chat_id, string $message, int $reply_to_message_id = 0, array $keyboard = [], $parseMode = null)
    {
        $to_send['chat_id'] = $chat_id;
        $to_send['text'] = $message;

        if(!empty($reply_to_message_id)) {
            $to_send['message_id'] = $reply_to_message_id;
        }

        if (! empty($keyboard)) {
            $to_send['reply_markup'] = TelegramInlineKeyboardMarkup::obj()->createInlineKeyboard($keyboard);
        }

        if (!empty($parseMode)) {
            $to_send['parse_mode'] = $parseMode;
        }

        return $this->telegram->curlPost('sendMessage',
            $to_send
        );
    }

    public function forwardMessage(int $chat_id, string $from_chat_id, int $message_id)
    {
        return $this->telegram->curlPost('forwardMessage',
            [
                'from_chat_id' => "$from_chat_id", // from chat id
                'chat_id'      => "$chat_id",      // target chat id
                'message_id'   => "$message_id",   // message to forward
            ],
        );
    }

    public function copyMessage(int $chat_id, string $from_chat_id, int $message_id)
    {
        return $this->telegram->curlPost('copyMessage',
            [
                'from_chat_id' => $from_chat_id, // from chat id
                'message_id'   => $message_id,   // message to forward
                'chat_id'      => $chat_id,      // target chat id
            ],
        );
    }

    public function forwardAndDeleteAndGetText(int $chat_id, string $from_chat_id, int $message_id)
    {
        $forwarded = $this->forwardMessage($chat_id, $from_chat_id, $message_id);
        if (empty($forwarded['ok'])) {
            return '';
        }else{
            $forwardedMessageId = $forwarded['result']['message_id'] ?? 0;
        }
        if(!empty($forwardedMessageId)){
            $this->deleteMessage($chat_id, $forwardedMessageId);
        }

        return $forwarded['result']['text'] ?? '';
    }

    public function deleteMessage(int $chat_id, int $message_id)
    {
        return $this->telegram->curlPost('deleteMessage',
            [
                'chat_id'      => $chat_id,      // target chat id
                'message_id'   => $message_id,   // message to forward
            ],
        );
    }

    private function sendFileValidation(string $file_or_url): CURLFile|string
    {
        if (file_exists($file_or_url)) {
            return curl_file_create($file_or_url);
        }

        return $file_or_url;
    }

    public function sendPhoto(int $chat_id, string $file_or_url, $reply_to_message_id = 0, string $caption = '', $has_spoiler = false)
    {
        return $this->telegram->curlFilePostFile('sendPhoto', [
            'chat_id'             => $chat_id,
            'photo'               => $this->sendFileValidation($file_or_url),
            'reply_to_message_id' => $reply_to_message_id,
            'caption'             => $caption,
            'has_spoiler'         => $has_spoiler,
        ]);
    }

    public function sendAudio(int $chat_id, string $file_or_url, $reply_to_message_id = 0, string $caption = '', string $title = '')
    {
        return $this->telegram->curlFilePostFile('sendAudio', [
            'chat_id'             => $chat_id,
            'audio'               => $this->sendFileValidation($file_or_url),
            'reply_to_message_id' => $reply_to_message_id,
            'caption'             => $caption,
            'title'               => $title,
        ]);
    }

    public function sendDocument(int $chat_id, string $file_or_url, $reply_to_message_id = 0, string $caption = '')
    {
        return $this->telegram->curlFilePostFile('sendDocument', [
            'chat_id'             => $chat_id,
            'document'            => $this->sendFileValidation($file_or_url),
            'reply_to_message_id' => $reply_to_message_id,
            'caption'             => $caption,
        ]);
    }

    public function sendVideo(int $chat_id, string $file_or_url, $reply_to_message_id = 0, string $caption = '')
    {
        return $this->telegram->curlFilePostFile('sendVideo', [
            'chat_id'             => $chat_id,
            'video'               => $this->sendFileValidation($file_or_url),
            'reply_to_message_id' => $reply_to_message_id,
            'caption'             => $caption,
        ]);
    }

    public function sendVoice(int $chat_id, string $file_or_url, $reply_to_message_id = 0, string $caption = '')
    {
        return $this->telegram->curlFilePostFile('sendVoice', [
            'chat_id'             => $chat_id,
            'voice'               => $this->sendFileValidation($file_or_url),
            'reply_to_message_id' => $reply_to_message_id,
            'caption'             => $caption,
        ]);
    }

    public function sendVideoNote(int $chat_id, string $file_or_url, $reply_to_message_id = 0)
    {
        return $this->telegram->curlFilePostFile('sendVideoNote', [
            'chat_id'             => $chat_id,
            'video_note'          => $this->sendFileValidation($file_or_url),
            'reply_to_message_id' => $reply_to_message_id,
        ]);
    }

    public function action(): TelegramSendAction
    {
        return $this->action;
    }
}