<?php
/**
 * @PHP       Version >= 8.0
 * @Liberary  TelegramBot
 * @Project   TelegramBot
 * @copyright ©2024 Maatify.dev
 * @see       https://www.maatify.dev Visit Maatify.dev
 * @link      https://github.com/Maatify/TelegramBot View project on GitHub
 * @since     2023-07-16 2:14 PM
 * @author    Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @Maatify   TelegramBot :: TelegramSendAction
 * @note      This Project using for Call Telegram API
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
    }
    public function typing(int $chat_id): array
    {
        return $this->sendChatAction($chat_id, TelegramActions::TYPING);
    }

    public function uploadPhoto(int $chat_id): array
    {
        return $this->sendChatAction($chat_id, TelegramActions::UPLOAD_PHOTO);
    }

    public function recordVideo(int $chat_id): array
    {
        return $this->sendChatAction($chat_id, TelegramActions::RECORD_VIDEO);
    }

    public function uploadVideo(int $chat_id): array
    {
        return $this->sendChatAction($chat_id, TelegramActions::UPLOAD_VIDEO);
    }

    public function recordVoice(int $chat_id): array
    {
        return $this->sendChatAction($chat_id, TelegramActions::RECORD_VOICE);
    }

    public function uploadVoice(int $chat_id): array
    {
        return $this->sendChatAction($chat_id, TelegramActions::UPLOAD_VOICE);
    }

    public function uploadDocument(int $chat_id): array
    {
        return $this->sendChatAction($chat_id, TelegramActions::UPLOAD_DOCUMENT);
    }

    public function chooseSticker(int $chat_id): array
    {
        return $this->sendChatAction($chat_id, TelegramActions::CHOOSE_STICKER);
    }

    public function findLocation(int $chat_id): array
    {
        return $this->sendChatAction($chat_id, TelegramActions::FIND_LOCATION);
    }

    public function recordVideoNote(int $chat_id): array
    {
        return $this->sendChatAction($chat_id, TelegramActions::RECORD_VIDEO_NOTE);
    }

    public function uploadVideoNote(int $chat_id): array
    {
        return $this->sendChatAction($chat_id, TelegramActions::UPLOAD_VIDEO_NOTE);
    }

    private function sendChatAction(int $chat_id, string $action): array
    {
        return $this->telegram->curlPost('sendChatAction', [
            'chat_id' => $chat_id,
            'action' => $action
        ]);
    }
}