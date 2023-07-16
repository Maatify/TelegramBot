<?php
/**
 * Created by Maatify.dev
 * User: Maatify.dev
 * Date: 2023-07-16
 * Time: 2:14 PM
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

class TelegramSendAction
{
    private static self $instance;
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
    }
    public function Typing(int $chat_id): array
    {
        return $this->SendChatAction($chat_id, TelegramActions::TYPING);
    }

    public function UploadPhoto(int $chat_id): array
    {
        return $this->SendChatAction($chat_id, TelegramActions::UPLOAD_PHOTO);
    }

    public function RecordVideo(int $chat_id): array
    {
        return $this->SendChatAction($chat_id, TelegramActions::RECORD_VIDEO);
    }

    public function UploadVideo(int $chat_id): array
    {
        return $this->SendChatAction($chat_id, TelegramActions::UPLOAD_VIDEO);
    }

    public function RecordVoice(int $chat_id): array
    {
        return $this->SendChatAction($chat_id, TelegramActions::RECORD_VOICE);
    }

    public function UploadVoice(int $chat_id): array
    {
        return $this->SendChatAction($chat_id, TelegramActions::UPLOAD_VOICE);
    }

    public function UploadDocument(int $chat_id): array
    {
        return $this->SendChatAction($chat_id, TelegramActions::UPLOAD_DOCUMENT);
    }

    public function ChooseSticker(int $chat_id): array
    {
        return $this->SendChatAction($chat_id, TelegramActions::CHOOSE_STICKER);
    }

    public function FindLocation(int $chat_id): array
    {
        return $this->SendChatAction($chat_id, TelegramActions::FIND_LOCATION);
    }

    public function RecordVideoNote(int $chat_id): array
    {
        return $this->SendChatAction($chat_id, TelegramActions::RECORD_VIDEO_NOTE);
    }

    public function UploadVideoNote(int $chat_id): array
    {
        return $this->SendChatAction($chat_id, TelegramActions::UPLOAD_VIDEO_NOTE);
    }

    private function SendChatAction(int $chat_id, string $action): array
    {
        return $this->telegram->CurlPost('sendChatAction', [
            'chat_id' => $chat_id,
            'action' => $action
        ]);
    }
}