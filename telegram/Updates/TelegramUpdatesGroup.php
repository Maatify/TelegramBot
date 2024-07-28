<?php
/**
 * @PHP       Version >= 8.0
 * @Liberary  TelegramBot
 * @Project   TelegramBot
 * @copyright ©2024 Maatify.dev
 * @see       https://www.maatify.dev Visit Maatify.dev
 * @link      https://github.com/Maatify/TelegramBot View project on GitHub
 * @since     2023-07-15 2:35 PM
 * @author    Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @Maatify   TelegramBot :: TelegramUpdatesGroup
 * @note      This Project using for Call Telegram API
 *
 * This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

namespace Maatify\TelegramBot\Updates;

use Exception;
use Maatify\TelegramBot\TelegramRequest;

class TelegramUpdatesGroup extends TelegramUpdates
{
    private static self $instance;

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
        parent::__construct($telegram);
    }

    /**
     * @throws Exception
     */
    public function ByChatID(): array
    {
        return $this->Group('id');
    }

    /**
     * @throws Exception
     */
    public function ByUsername(): array
    {
        return $this->Group('username');
    }

    /**
     * @throws Exception
     */
    public function ByFirstName(): array
    {
        return $this->Group('first_name');
    }

    /**
     * @throws Exception
     */
    private function Group(string $index_name): array
    {
        $this->Updates();
        $ids = array();
        foreach ($this->updates as $update){
            if(!in_array($update['message']['chat'][$index_name], $ids)){
                $ids[$update['message']['chat'][$index_name]][] = $update;
            }
        }
        return $ids;
    }

}