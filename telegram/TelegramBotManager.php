<?php
/**
 * Created by Maatify.dev
 * User: Maatify.dev
 * Date: 2023-07-15
 * Time: 7:41 AM
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

use Exception;
use Maatify\TelegramBot\Chat\TelegramChat;
use Maatify\TelegramBot\Update\TelegramUpdate;
use Maatify\TelegramBot\Updates\TelegramUpdates;
use Maatify\TelegramBot\Updates\TelegramUpdatesGroup;
use Maatify\TelegramBot\Webhook\TelegramWebhook;

class TelegramBotManager
{
    private static self $instance;
    private Request $telegram;

    public TelegramMethods $methods;
    public TelegramUpdates $updates;
    private TelegramUpdatesGroup $updates_grouped;
    private TelegramChat $chat;
    private TelegramWebhook $webhook;
    private TelegramSender $sender;
    private TelegramFile $downloader;

    /**
     * @throws Exception
     */
    public static function obj(string $api_key): self
    {
        if (empty(self::$instance)) {
            self::$instance = new self($api_key);
        }

        return self::$instance;
    }

    /**
     * @throws Exception
     */
    public function __construct(string $api_key)
    {
        $this->telegram = Request::obj($api_key);
        $this->methods = TelegramMethods::obj($this->telegram);
        $this->updates = TelegramUpdates::obj($this->telegram);
        $this->updates_grouped = TelegramUpdatesGroup::obj($this->telegram);
        $this->chat = TelegramChat::obj($this->telegram);
        $this->webhook = TelegramWebhook::obj($this->telegram);
        $this->sender = TelegramSender::obj($this->telegram);
        $this->downloader = TelegramFile::obj($this->telegram);
    }

    public function Downloader(): TelegramFile
    {
        return $this->downloader;
    }

    public function Methods(): TelegramMethods
    {
        return $this->methods;
    }

    public function Sender(): TelegramSender
    {
        return $this->sender;
    }

    /**
     * @throws Exception
     */
    public function GetChat(int $chat_id): TelegramChat
    {
        return $this->chat->GetChat($chat_id);
    }

    /**
     * @throws Exception
     */
    public function GetUpdates(): array
    {
        return $this->updates->GetUpdates();
    }

    /**
     * @throws Exception
     */
    public function LastUpdate(): TelegramUpdate
    {
        return $this->updates->LastUpdate();
    }

    /**
     * @throws Exception
     */
    public function FirstUpdate(): TelegramUpdate
    {
        return $this->updates->FirstUpdate();
    }

    /**
     * @throws Exception
     */
    public function Update(int $index): TelegramUpdate
    {
        return $this->updates->Update($index);
    }

    public function UpdatesGrouped(): TelegramUpdatesGroup
    {
        return $this->updates_grouped;
    }

    public function Webhook(): TelegramWebhook
    {
        return $this->webhook;
    }

}