<?php
/**
 * Created by Maatify.dev
 * User: Maatify.dev
 * Date: 2023-07-14
 * Time: 4:28 PM
 * https://www.Maatify.dev
 */

/**
 * @PHP Version >= 8.0
 * @Project   TelegramBot
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

class TelegramMethods
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
        if($me = $this->telegram->CurlGet($method)){
            if(!empty($me['ok']) && !empty($me['result'])){
                return $me['result'];
            }
        }
        @throw new Exception('Cannot get ' . $method);
    }




}