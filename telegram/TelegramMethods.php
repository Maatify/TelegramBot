<?php
/**
 * @PHP       Version >= 8.0
 * @Liberary  TelegramBot
 * @Project   TelegramBot
 * @copyright ©2024 Maatify.dev
 * @see       https://www.maatify.dev Visit Maatify.dev
 * @link      https://github.com/Maatify/TelegramBot View project on GitHub
 * @since     2023-07-14 4:28 PM
 * @author    Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @Maatify   TelegramBot :: TelegramMethods
 * @note      This Project using for Call Telegram API
 *
 * This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

namespace Maatify\TelegramBot;

use Exception;

class TelegramMethods
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

    /**
     * @throws Exception
     */
    public function GetMe()
    {
        return $this->HandleResponse('getMe');
    }


    /**
     * @throws Exception
     */
    public function Logout()
    {
        return $this->HandleResponse('logOut');
    }

    /**
     * @throws Exception
     */
    public function Close()
    {
        return $this->HandleResponse('close');
    }

    /**
     * @throws Exception
     */
    private function HandleResponse(string $method){
        if($me = $this->telegram->curlGet($method)){
            if(!empty($me['ok']) && !empty($me['result'])){
                return $me['result'];
            }
        }
        @throw new Exception('Cannot get ' . $method);
    }




}