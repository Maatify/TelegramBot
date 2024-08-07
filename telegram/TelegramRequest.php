<?php
/**
 * @PHP       Version >= 8.0
 * @Liberary  TelegramBot
 * @Project   TelegramBot
 * @copyright ©2024 Maatify.dev
 * @see       https://www.maatify.dev Visit Maatify.dev
 * @link      https://github.com/Maatify/TelegramBot View project on GitHub
 * @since     2023-07-14 3:35 PM
 * @author    Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @Maatify   TelegramBot :: TelegramRequest
 * @note      This Project using for Call Telegram API
 *
 * This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

namespace Maatify\TelegramBot;

use CurlHandle;
use Maatify\Functions\GeneralFunctions;
use Maatify\Logger\Logger;

class TelegramRequest
{
    private static self $instance;

    private string $main_url = 'https://api.telegram.org/bot';
    private string $file_url = 'https://api.telegram.org/file/bot';
    private string $api_url;
    private string $api_file_url;
    private string $url;
    private false|CurlHandle $ch;
    private array $params;

    public static function obj(string $api_key): self
    {
        if (empty(self::$instance)) {
            self::$instance = new self($api_key);
        }

        return self::$instance;
    }

    public function __construct(string $api_key)
    {
        $this->api_url = $this->main_url . $api_key . '/';
        $this->api_file_url = $this->file_url . $api_key . '/';
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, 120);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($this->ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    }

    public function curlGetFile($file_path): string
    {
        return $this->url = $this->api_file_url . $file_path;
    }

    public function curlFilePostFile(string $method, array $params)
    {
        $this->params = $params;
        $this->url = $this->api_url . $method;
        curl_setopt($this->ch, CURLOPT_POST, 1);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: multipart/form-data",
        ));

        return $this->call();
    }

    public function curlPost(string $method, array $params)
    {
        $this->url = $this->api_url . $method;
        $this->params = $params;
        curl_setopt($this->ch, CURLOPT_POST, 1);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
        ));

        return $this->call();
    }

    public function curlGet(string $method)
    {
        $this->url = $this->api_url . $method;
        $this->params = [];
        curl_setopt($this->ch, CURLOPT_POST, 0);
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
        ));

        return $this->call();
    }

    private function call()
    {
        curl_setopt($this->ch, CURLOPT_URL, $this->url);

        $result = curl_exec($this->ch);
        $httpCode = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
        $curl_errno = curl_errno($this->ch);
        $curl_error = curl_error($this->ch);
        curl_close($this->ch);
        if ($curl_errno > 0) {
            $this->logError("(err-" . __METHOD__ . ") cURL Error ($curl_errno): $curl_error");
        } else {
            if ($resultArray = json_decode($result, true)) {
                $this->logSuccess($resultArray);

                return $resultArray;
            } else {
                $this->logError(($httpCode != 200) ? "Error header response " . $httpCode : "There is no response from server (err-" . __METHOD__ . ")");
            }
        }

        return [];
    }

    private function logSuccess(array $result): void
    {
        $this->log('success', success: $result);
    }

    private function logError(string $message): void
    {
        $this->log('failed', error_details: $message);
    }

    private function log(string $file_name, string $error_details = '', array $success = []): void
    {
        if (! empty($error_details)) {
            $log['error'] = $error_details;
        }
        if (! empty($success)) {
            $log['success'] = $success;
        }
        $log['params'] = $this->params;
        $log['url'] = $this->url;
        Logger::RecordLog($log, 'telegram/curl/telegram_' . $file_name . '_' . GeneralFunctions::CurrentMicroTimeStamp());
    }
}