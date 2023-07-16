<?php
/**
 * Created by Maatify.dev
 * User: Maatify.dev
 * Date: 2023-07-15
 * Time: 11:05 PM
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

namespace Maatify\TelegramBot\Chat;

use Exception;
use Maatify\Logger\Logger;
use Maatify\TelegramBot\Request;

class TelegramChat
{
    private static self $instance;
    private Request $telegram;
    private array $getter;

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

    /**
     * @throws Exception
     */
    public function GetChat(int $chat_id): static
    {
        if($chat = $this->telegram->CurlPost('getChat', ['chat_id'=>$chat_id])){
            if(!empty($chat['ok']) && !empty($chat['result'])){
                $this->getter = $chat['result'];
                return $this;
            }else{
                Logger::RecordLog($chat, 'telegram_failed');
                @throw new Exception('result not ok');
            }
        }
        @throw new Exception('Cannot get Updates');
    }

    public function GetID()
    {
        return $this->Get('id');
    }

    public function GetFirstName()
    {
        return $this->Get('first_name');
    }

    public function GetLastName()
    {
        return $this->Get('last_name');
    }

    public function GetUsername()
    {
        return $this->Get('username');
    }

    public function GetType()
    {
        return $this->Get('type');
    }

    public function GetActiveUsername()
    {
        return $this->Get('active_usernames');
    }

    public function Get(string $key = '')
    {
        if(empty($key)){
            return $this->getter;
        }else{
            return $this->getter[$key] ?? '';
        }

    }
}