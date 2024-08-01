<?php
/**
 * @PHP       Version >= 8.0
 * @Liberary  TelegramBot
 * @Project   TelegramBot
 * @copyright ©2024 Maatify.dev
 * @see       https://www.maatify.dev Visit Maatify.dev
 * @link      https://github.com/Maatify/TelegramBot View project on GitHub
 * @since     2023-07-15 7:29 AM
 * @author    Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @Maatify   TelegramBot :: TelegramUpdateTrait
 * @note      This Project using for Call Telegram API
 *
 * This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

namespace Maatify\TelegramBot\Updates;

use Exception;
use Maatify\Logger\Logger;
use Maatify\TelegramBot\TelegramRequest;
use Maatify\TelegramBot\Update\TelegramUpdate;
use Maatify\TelegramBot\Update\TelegramUpdateMessage;

class TelegramUpdates
{
    protected array $updates = [];

    protected TelegramRequest $telegram;
    private static self $instance;
    private TelegramUpdate $update;
    public TelegramUpdateMessage $message;

    /**
     * @throws Exception
     */
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

    /**
     * @throws Exception
     */
    protected function Updates(): void
    {
        if($updates = $this->telegram->curlGet('getUpdates')){
            if(!empty($updates['ok']) && !empty($updates['result'])){
                $this->updates = $updates['result'];
                return;
            }else{
                Logger::RecordLog($updates, 'telegram_failed');
                @throw new Exception('result not ok');
            }
        }
        @throw new Exception('Cannot get Updates');
    }

    /**
     * @throws Exception
     */
    public function GetUpdates(): array
    {
        $this->Updates();
        if(!empty($this->updates)){
            return $this->updates;
        }
        return [];
    }

    /**
     * @throws Exception
     */
    public function LastUpdate(): TelegramUpdate
    {
        $this->Updates();
        if($count = sizeof($this->updates)){
            $this->update = TelegramUpdate::obj($this->updates[$count-1]);
            $this->message = TelegramUpdateMessage::obj($this->update->Get('message'));
        }
        return $this->update;
    }

    /**
     * @throws Exception
     */
    public function FirstUpdate(): TelegramUpdate
    {
        $this->Updates();
        if(!empty($this->updates[0])) {
            $this->update = TelegramUpdate::obj($this->updates[0]);
            $this->message = TelegramUpdateMessage::obj($this->update->Get('message'));
        }
        return $this->update;
    }

    /**
     * @throws Exception
     */
    public function Update(int $index): TelegramUpdate
    {
        $this->Updates();
        if(!empty($this->updates[$index])) {
            $this->update = TelegramUpdate::obj($this->updates[$index]);
            $this->message = TelegramUpdateMessage::obj($this->update->Get('message'));
        }
        return $this->update;
    }

    public function UpdateID()
    {
        return $this->update->Get('update_id');
    }
}