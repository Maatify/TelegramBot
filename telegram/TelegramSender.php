<?php
/**
 * Created by Maatify.dev
 * User: Maatify.dev
 * Date: 2023-07-16
 * Time: 9:55 AM
 * https://www.Maatify.dev
 */

/**
 * @PHP Version >= 8.0
 * @Liberary    TelegramBot
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

namespace Maatify\TelegramBot;

use CURLFile;

class TelegramSender
{
    private static self $instance;
    private TelegramSendAction $action;
    private Request $telegram;

    public static function obj(Request $telegram): self
    {
        if (empty(self::$instance)) {
            self::$instance = new self($telegram);
        }

        return self::$instance;
    }

    public function __construct(Request $telegram)
    {
        $this->telegram = $telegram;
        $this->action = TelegramSendAction::obj($telegram);
    }

    public function SendMessage(int $chat_id, string $message, int $reply_to_message_id = 0)
    {
        return $this->telegram->CurlPost('sendMessage',
            [
                'chat_id'             => $chat_id,
                'text'                => $message,
                'reply_to_message_id' => $reply_to_message_id,
            ]
        );
    }

    public function ForwardMessage(int $chat_id, string $from_chat_id, int $message_id)
    {
        return $this->telegram->CurlPost('forwardMessage',
            [
                'from_chat_id' => "$from_chat_id", // from chat id
                'chat_id'      => "$chat_id",      // target chat id
                'message_id'   => "$message_id",   // message to forward
            ],
        );
    }

    public function CopyMessage(int $chat_id, string $from_chat_id, int $message_id)
    {
        return $this->telegram->CurlPost('copyMessage',
            [
                'from_chat_id' => $from_chat_id, // from chat id
                'chat_id'      => $chat_id,      // target chat id
                'message_id'   => $message_id,   // message to forward
            ],
        );
    }

    private function SendFileValidation(string $file_or_url): CURLFile|string
    {
        if (file_exists($file_or_url)) {
            return curl_file_create($file_or_url);
        }

        return $file_or_url;
    }

    public function SendPhoto(int $chat_id, string $file_or_url, $reply_to_message_id = 0, string $caption = '', $has_spoiler = false)
    {
        return $this->telegram->CurlFilePostFile('sendPhoto', [
            'chat_id'             => $chat_id,
            'photo'               => $this->SendFileValidation($file_or_url),
            'reply_to_message_id' => $reply_to_message_id,
            'caption'             => $caption,
            'has_spoiler'         => $has_spoiler,
        ]);
    }

    public function SendAudio(int $chat_id, string $file_or_url, $reply_to_message_id = 0, string $caption = '', string $title = '')
    {
        return $this->telegram->CurlFilePostFile('sendAudio', [
            'chat_id'             => $chat_id,
            'audio'               => $this->SendFileValidation($file_or_url),
            'reply_to_message_id' => $reply_to_message_id,
            'caption'             => $caption,
            'title'               => $title,
        ]);
    }

    public function SendDocument(int $chat_id, string $file_or_url, $reply_to_message_id = 0, string $caption = '')
    {
        return $this->telegram->CurlFilePostFile('sendDocument', [
            'chat_id'             => $chat_id,
            'document'            => $this->SendFileValidation($file_or_url),
            'reply_to_message_id' => $reply_to_message_id,
            'caption'             => $caption,
        ]);
    }

    public function SendVideo(int $chat_id, string $file_or_url, $reply_to_message_id = 0, string $caption = '')
    {
        return $this->telegram->CurlFilePostFile('sendVideo', [
            'chat_id'             => $chat_id,
            'video'               => $this->SendFileValidation($file_or_url),
            'reply_to_message_id' => $reply_to_message_id,
            'caption'             => $caption,
        ]);
    }

    public function SendVoice(int $chat_id, string $file_or_url, $reply_to_message_id = 0, string $caption = '')
    {
        return $this->telegram->CurlFilePostFile('sendVoice', [
            'chat_id'             => $chat_id,
            'voice'               => $this->SendFileValidation($file_or_url),
            'reply_to_message_id' => $reply_to_message_id,
            'caption'             => $caption,
        ]);
    }

    public function SendVideoNote(int $chat_id, string $file_or_url, $reply_to_message_id = 0)
    {
        return $this->telegram->CurlFilePostFile('sendVideoNote', [
            'chat_id'             => $chat_id,
            'video_note'          => $this->SendFileValidation($file_or_url),
            'reply_to_message_id' => $reply_to_message_id,
        ]);
    }

    public function Action(): TelegramSendAction
    {
        return $this->action;
    }
}