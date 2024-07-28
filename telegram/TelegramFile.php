<?php
/**
 * @PHP       Version >= 8.0
 * @Liberary  TelegramBot
 * @Project   TelegramBot
 * @copyright ©2024 Maatify.dev
 * @see       https://www.maatify.dev Visit Maatify.dev
 * @link      https://github.com/Maatify/TelegramBot View project on GitHub
 * @since     2023-07-16 3:18 PM
 * @author    Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @Maatify   TelegramBot :: TelegramFile
 * @note      This Project using for Call Telegram API
 *
 * This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

namespace Maatify\TelegramBot;

use Exception;

class TelegramFile
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
    public function DownloadUserProfilePhotos(int $user_id): void
    {
        $user = $this->GetUserProfilePhotos($user_id);
        if(!empty($user['ok']) && !empty($user['result'])){
            if(!empty($photos = $user['result']['photos'])){
                $last_photos = $photos[0];
                $size = sizeof($last_photos);
                $last_photo = $last_photos[$size-1]['file_id'];
                $file  = $this->GetFile($last_photo);
                if(!empty($file['ok']) && !empty($file['result']['file_path'])){
                    $this->SaveFile($file['result']['file_path'], $user_id);
                }
            }
        }
        @throw new Exception('Error While Download User Image');
    }

    private function GetUserProfilePhotos(int $user_id)
    {
        return $this->telegram->CurlPost('getUserProfilePhotos', ['user_id' => $user_id]);
    }

    private function GetFile(string $file_id)
    {
        return $this->telegram->CurlPost('getFile', ['file_id' => $file_id]);
    }

    /**
     * @throws Exception
     */
    private function SaveFile(string $file_path, int $user_id): void
    {
        $file_url = $this->telegram->CurlGetFile($file_path);
        $file_type = strtolower(pathinfo($file_url, PATHINFO_EXTENSION));
        header('Content-Disposition: attachment;filename="user-' . $user_id . '-' . time() . '.' . $file_type . '"');
        $file = @fopen($file_url, "rb");
        if ($file) {
            while (! feof($file)) {
                print(fread($file, 1024 * 8));
                flush();
                if (connection_status() != 0) {
                    @fclose($file);
                    die();
                }
            }
            @fclose($file);
        }
        @throw new Exception('Error While Download User Image');
    }
}