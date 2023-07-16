<?php
/**
 * Created by Maatify.dev
 * User: Maatify.dev
 * Date: 2023-07-16
 * Time: 7:06 AM
 * https://www.Maatify.dev
 */

/**
 * @PHP Version >= 8.0
 * @Liberary   TelegramBot
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

namespace Maatify\TelegramBot\Webhook;

use Maatify\TelegramBot\Update\TelegramUpdate;

class WebhookUpdate
{
    private TelegramUpdate $update;

    public function __construct()
    {
        if(empty($_POST)){
            $response = file_get_contents('php://input');
            $response = json_decode($response, true);
            $_POST = json_decode(json_encode($response), true);
        }
        $this->update = TelegramUpdate::obj($_POST);
    }

    public function Update(): TelegramUpdate
    {
        return $this->update;
    }
}